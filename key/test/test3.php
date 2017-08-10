<?PHP  

//socket获取头2

       function check_url($url){  
              //解析url  
              $url_pieces = parse_url($url);  
              //设置正确的路径和端口号  
              $path =(isset($url_pieces['path']))?$url_pieces['path']:'/';  
              $port =(isset($url_pieces['port']))?$url_pieces['port']:'80';  
              //用fsockopen()尝试连接  
              if($fp =fsockopen($url_pieces['host'],$port,$errno,$errstr,30)){  
                     //建立成功后，向服务器写入数据  
                     $send = "HEAD $path HTTP/1.1\r\n";  
                     // $send .= "HOST:".$url_pieces['host']."\r\n";  
                     // $send .= "CONNECTION: CLOSE\r\n\r\n";  
                     fwrite($fp,$send);  
                     //检索HTTP状态码  
                     $data = fgets($fp,128);  
                     //关闭连接  
                     fclose($fp);  
                     //返回状态码和类信息  
                     list($response,$code) = explode(' ',$data);  
                     if($code == 200){  
                            return array($code,'good');  
                     }else{  
                            return array($code,'bad');//数组第二个元素作为css类名  
                     }  
              }else{  
                     //没有连接  
                     return array($errstr,'bad');  
              }  
               
       } 

       set_time_limit(10);//无限长时间完成任务  
       //创建URL列表  
       $urls = array(  
              'http://www.sdust.com',  
              'http://www.example.com'  
       );
       //调整PHP脚本的时间限制：  
       
       //逐个验证url： 
       foreach($urls as $url){  
              list($code,$class) = check_url($url);  
              echo "<p><a href =\"$url\">$url</a>(<span class =\"$class\">$code</span>)</p>";  
               
       }  
?> 