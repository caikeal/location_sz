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
    triggers {
        gitlab(triggerOnPush: true, triggerOnMergeRequest: true, branchFilterType: 'All')
    }
    //pipeline的各个阶段场景
    stages {
    
        stage('测试拉去代码'){
            steps{
                script{
                    echo "拉取代码哦~"
                    // 拉取git源码
                    checkout([
                        $class: 'GitSCM', 
                        branches: [[name: '*/develop']],        
                        userRemoteConfigs: [[credentialsId: "github", url: "git@github.com:caikeal/location_sz.git"]]
                    ])
                }
            }
        }

    }
}