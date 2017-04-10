
<?php 

    function httpGet($url,$headers = null) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        if(!is_null($headers))
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

    function httpPostSSL($url,$vars,$headers = null){
        $ch = curl_init();
        //超时时间
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_TIMEOUT,500);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if(!is_null($headers))
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        //windows
//        curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'\ca\apiclient_cert.pem');
        //nux
        curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/ca/apiclient_cert.pem');
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        //windows
//        curl_setopt($ch,CURLOPT_SSLKEY,getcwd().'\ca\apiclient_key.pem');
        //nux
        curl_setopt($ch,CURLOPT_SSLKEY,getcwd().'/ca/apiclient_key.pem');
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);

        curl_setopt($ch,CURLOPT_URL,$url);
        $res = curl_exec($ch);

        if($res){
            curl_close($ch);
            return $res;
        }
        else {
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
        }

    }

    function httpPost($url,$vars,$headers = null){
        $ch = curl_init();
        //超时时间
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_TIMEOUT,500);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if(!is_null($headers))
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);

        curl_setopt($ch,CURLOPT_URL,$url);
        $res = curl_exec($ch);

        if($res){
            curl_close($ch);
            return $res;
        }
        else {
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
        }

    }
