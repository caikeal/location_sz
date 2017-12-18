pipeline {
    //在任何可用的代理上执行Pipeline
    agent any
    //参数化变量，目前只支持[booleanParam, choice, credentials, file, text, password, run, string]这几种参数类型，其他高级参数化类型还需等待社区支持。
    parameters {
        //git代码路径【参数值对外隐藏】
        string(name:'repoUrl', defaultValue: 'git@git.*****.com:*****/*****.git', description: 'git代码路径')
        //repoBranch参数后续替换成git parameter不再依赖手工输入,JENKINS-46451【git parameters目前还不支持pipeline】
        string(name:'repoBranch', defaultValue: 'master', description: 'git分支名称')
        //若勾选在pipelie完成后会邮件通知测试人员进行验收
        booleanParam(name: 'isCommitQA', description: '是否邮件通知测试人员进行人工验收', defaultValue: false )
    }
    //常量参数，初始确定后一般不需更改
    environment{
        //验收人员邮箱地址【参数值对外隐藏】
        QA_EMAIL_LIST='caikeal@qq.com,546487590@qq.com'
    }
    options {
        //保持构建的最大个数
        buildDiscarder(logRotator(numToKeepStr: '10')) 
    }

    //pipeline的各个阶段场景
    stages {
    
        stage('通知人工验收'){
            steps{
                script{
                    wrap([$class: 'BuildUser']) {
                        if(params.isCommitQA==false){
                            echo "不需要通知测试人员人工验收"
                        }else{
                            emailext (
                                body: """
                                <p>请开发组长用个人账户登录Jenkins Pipeline页面，请开发组长同意部署</p>
                                <p>Pipeline页面： <a href='${env.JENKINS_URL}blue/organizations/jenkins/${env.JOB_NAME}/detail/${env.JOB_NAME}/${env.BUILD_NUMBER}/pipeline'>${env.JOB_NAME}(pipeline page)</a></p>
                                """,
                                to: "${env.QA_EMAIL_LIST}",
                                subject: "${env.JOB_NAME}-${env.BUILD_NUMBER}-请开发组长同意部署",
                                attachLog: true
                            )
                        }
                    }
                }
            }
        }

    }
}