<?php


class JsonResponse extends Response {

    const STATUS_SUCCESS = 1;
    const STATUS_ERROR = 2;

    /**
     * @var array
     */
    private $data = array();

    private $status;
    public function get()
    {
        return json_encode(
            array(
                'status' => $this->status,
                'message' => $this->message,
                'data' => $this->data
            )
        );
    }

    public function setData($data){
        $this->data = $data;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public static function success($data=array(), $message=''){
        $response = new JsonResponse($message);
        $response->setData($data);
        $response->setStatus(JsonResponse::STATUS_SUCCESS);

        return $response->get();
    }

    public static function error($message='An error has occurred', $data=array()){
        $response = new JsonResponse($message);
        $response->setData($data);
        $response->setStatus(JsonResponse::STATUS_ERROR);

        return $response->get();
    }
} 