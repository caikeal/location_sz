<?php
/**
 * Created by PhpStorm.
 * User: keal
 * Date: 2017/5/26
 * Time: 下午1:13
 */

namespace Api\Controllers;


use Api\BaseController;
use App\Models\Beacon;
use App\Transformers\BeaconTransformer;
use Illuminate\Http\Request;

class BeaconController extends BaseController
{
    /**
     * 获取beacon列表数据
     * @return mixed
     */
    public function index()
    {
        $beacons = Beacon::get();
        return $this->response()->collection($beacons, BeaconTransformer::class);
    }

    /**
     * 新建beacon
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $beacon = new Beacon();
        $beacon->x = $request->input('x');
        $beacon->y = $request->input('y');
        $beacon->major = $request->input('major');
        $beacon->minor = $request->input('minor');
        $beacon->floor = $request->input('floor') ?:1;
        if ($beacon->save()) {
            return $this->response()->array(["data" => ["message" => "success"]])->header('Access-Control-Allow-Origin', '*');
        }

        return $this->response()->errorBadRequest('保存失败')->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * 更新beacon
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        $beacon = Beacon::find($id);
        $beacon->x = $request->input('x');
        $beacon->y = $request->input('y');
        $beacon->major = $request->input('major');
        $beacon->minor = $request->input('minor');
        $beacon->floor = $request->input('floor') ?:1;
        $isSuccess = $beacon->update();
        return $this->response()->array(["data" => ["message" => "success", "info" => $beacon]]);
    }

    /**
     * 删除beacon
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $beacon = Beacon::where('id', $id)->delete();
        return $this->response()->array(["data" => ["message" => "success"]]);
    }
}