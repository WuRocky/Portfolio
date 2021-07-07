<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=？device-width, initial-scale=1.0" /> -->
    <title>使用裝置</title>


    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--- CSS -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css"> -->
    <!--Google font setting-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/style01.css" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->


</head>

<body>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <!-- 上標籤 -->
    <header class="page-header1 wrapper">
        <div class="container">
            <div class="logo">

                <a href="./index.php">
                    <img src="./logo/icons8-intelligent-person-64.png" alt="智能手錶首頁">
                </a>
                <h1 class="logo-h1">IoT&nbsp;Watch</h1>
                <li class="signupbtn"><?php if (!isset($_SESSION['username'])) : ?><a href="./signup.php"><img src="./Icons/signup.png" /><?php endif ?></li>
                <li class="loginbtn"><?php if (!isset($_SESSION['username'])) : ?><a href="./login.php"><img src="./Icons/login.png" /><?php endif ?></li>

            </div>
        </div>
        <div class="container">

            <nav class="main-nav">
                <li><a href="./member.php"><?php echo htmlspecialchars($_SESSION["username"]) ?></a></li>
                <li><?php if (isset($_SESSION['username'])) : ?><a href="./php/logout.php">登出</a></a><?php endif ?></li>
                <li><a href="./index.php">首頁</a></li>


                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">裝置介紹</a>
                    <div class="dropdown-content">
                        <a href="./devices.php">裝備使用</a>
                        <a href="./features.php">功能介紹</a>
                        <a href="./members.php">成員介紹</a>
                    </div>
                </li>

                <li><a href="./Datacharts.php">測量圖</a></li>

                <li><a href="./video.php">影片介紹</a></li>
            </nav>

        </div>

    </header>

    <section>
        <!-- 下面左邊內容 -->
        <div class="side">
            <ul class="side-item">
                <li><a href="./devices.php">使用裝備</a></li>
                <li><a href="./features.php">功能介紹</a></li>
                <li><a href="./members.php">成員介紹</a></li>
            </ul>
        </div>

        <!-- 下面右邊內容 -->
        <div class="aside-device">



        <div>      
                
                
                <div class="button01">
                    <div class="button-container-1">
                            <span class="mas">影片介紹</span>
                            <button id='work' type="button" name="Hover"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">影片介紹</button>
                        </div>
                </div>
            
                    <div class="modal fade custom-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <video controls id="video1">
                                <source src="./members/IoT Watch.mp4" type="video/mp4">
                                </video>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- 介紹 -->
                    <div>

            
                        <img class="item-hints-photo" src="./Icons/device.jpg" alt="裝置圖片" />
                        <div class="item-hints">
                            <div class="hint" data-position="4">
                                <span class="hint-radius"></span>
                                <span class="hint-dot"></span>
                                    <div class="hint-content do--split-children">
                                        <p>心跳模組</p>
                                        <p>心跳偵測模組，用於偵測來自手指的心跳訊號</p>
                                    </div>
                            </div>
                        </div>

                        <div class="item-hints01">
                            <div class="hint" data-position="4">
                                <span class="hint-radius"></span>
                                <span class="hint-dot"></span>
                                    <div class="hint-content do--split-children">
                                        <p>OLED</p>
                                        <p>顯示手錶當下資訊，網路時鐘、溫濕度、熱指數、心律、運動模式</p>
                                    </div>
                            </div>
                        </div>

                        <div class="item-hints02">
                            <div class="hint" data-position="4">
                                <span class="hint-radius"></span>
                                <span class="hint-dot"></span>
                                    <div class="hint-content do--split-children">
                                        <p>ESP32</p>
                                        <p>手錶的計算核心，負責接收、處理感測器的訊號，並上傳至雲端伺服器</p>
                                    </div>
                            </div>
                        </div>


                        <div class="item-hints03">
                            <div class="hint" data-position="4">
                                <span class="hint-radius"></span>
                                <span class="hint-dot"></span>
                                    <div class="hint-content do--split-children">
                                        <p>溫溼度感測器</p>
                                        <p>用於偵測環境溫濕度，作為熱指數計算的參考</p>
                                    </div>
                            </div>
                        </div>

                        <div class="item-hints04">
                            <div class="hint" data-position="4">
                                <span class="hint-radius"></span>
                                <span class="hint-dot"></span>
                                    <div class="hint-content do--split-children">
                                        <p>G-sensor</p>
                                        <p>用於偵測步頻、速度及移動距離</p>
                                    </div>
                            </div>
                        </div>

                        <div class="item-hints05">
                            <div class="hint" data-position="4">
                                <span class="hint-radius"></span>
                                <span class="hint-dot"></span>
                                    <div class="hint-content do--split-children">
                                        <p>蜂鳴器</p>
                                        <p>在運動模式進入前提醒使用者當下的運動環境</p>
                                    </div>
                            </div>
                        </div>


                        <div class="item-hints06">
                            <div class="hint" data-position="4">
                                <span class="hint-radius"></span>
                                <span class="hint-dot"></span>
                                    <div class="hint-content do--split-children">
                                        <p>按鈕開關</p>
                                        <p>可切換OLED顯示的內容，及進入運動模式</p>
                                    </div>
                            </div>
                        </div>
                </div>
            </div>



            <div class="device-01">
                <div class="device-text-01">
                    <h1 class="title">ESP32</h1>
                    <hr>
                    <p class="description">為運動手錶之核心，負責接收、處理感測器訊號並上傳數據。</p>
                </div>
                <div class="device-img-01">
                    <img src="images/ESP32.jpeg">
                </div>
            </div>

            <div class="device-02">
                <div class="device-text-02">
                    <h1 class="title">OLED</h1>
                    <hr>
                    <p class="description">顯示四種不同模式→心跳、熱指數、溫濕度及時間。</p>
                </div>
                <div class="device-img-02">
                    <img src="images/OLED.jpg">
                </div>
            </div>

            <div class="device-03">
                <div class="device-text-01">
                    <h1 class="title">G-sensor</h1>
                    <hr>
                    <p class="description">量測加速度變化，提供步頻與距離的計算。</p>
                </div>
                <div class="device-img-01">
                    <img src="images/G_sensor.png">
                </div>
            </div>

            <div class="device-04">
                <div class="device-text-02">
                    <h1 class="title">Heart rate sensor</h1>
                    <hr>
                    <p class="description">量測手指的心跳。</p>
                </div>
                <div class="device-img-02">
                    <img src="images/heart_rate_sensor.png">
                </div>
            </div>

            <div class="device-05">
                <div class="device-text-01">
                    <h1 class="title">Temperature&humidity sensor</h1>
                    <hr>
                    <p class="description">量測溫濕度，提供熱指數的計算。</p>
                </div>
                <div class="device-img-01">
                    <img src="images/Temperature_humidity_sensor.jpg">
                </div>
            </div>

            <div class="device-06">
                <div class="device-text-02">
                    <h1 class="title">Buzzer</h1>
                    <hr>
                    <p class="description">警示的作用，提醒當前環境熱指數程度（共4階段）。</p>
                </div>
                <div class="device-img-02">
                    <img src="images/buzzer.jpg">
                </div>
            </div>
        </div>

    </section>

    <footer class="footer-wrapper">
        <div class="footer-logo">
                <h1><img class="footer-loge-img" src="./logo/icons8-intelligent-person-64.png" alt="Logo" />你的健康管家</h1>
            </div>
    
            <nav>
                <ul>
                    <li><a href="./index.php">首頁</a></li>
                    <li><a href="./features.php">裝置介紹</a></li>
                    <li><a href="./Datacharts.php">測量圖</a></li>
                    <li><a href="./video.php">影片介紹</a></li>  
                </ul>
            </nav>
            <section>
                <a class="section-img" href="#"><img src="./Icons/facebook-svgrepo-com.svg" alt="facebook" /></a>
                <a class="section-img" href="#"><img src="./Icons/instagram-svgrepo-com.svg" alt="instagram" /></a>
                <a class="section-img" href="#"><img src="./Icons/youtube.svg" alt="youtube" /></a>
            </section>
            <div>
                <span><a href="#">關於我們</a>&nbsp; |&nbsp; <a href="#">聯絡我們</a>&nbsp; | &nbsp;<a href="#">常見問答</a></span>
                <span>&nbsp; &nbsp; &copy;IoT Watch版權所有</span>
            </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
            jQuery(document).ready(function () {
    
        $("#myModal").on("shown.bs.modal", function () {
            $("#video1")[0].play();
        });
        $("#myModal").on("hidden.bs.modal", function () {
            $("#video1")[0].pause();
        });
        
        });
    
    
        </script>
</body>

</html>