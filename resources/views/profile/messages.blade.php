<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Messages</title>
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>
    <div class="container">
        <h3 class=" text-center">Messaging</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <input type="text" class="search-bar" placeholder="Search">
                                <span class="input-group-addon">
                                    <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <div class="chat_list active_chat">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mesgs">
                    <div class="msg_history" id="messagess">
                        <div>
                            <p id="msg"></p>
                            <div id="noti"></div>
                        </div>
                        <div class="incoming_msg">
                            <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p>Test which is a new approach to have all
                                        solutions</p>
                                    <span class="time_date"> 11:01 AM | June 9</span>
                                </div>
                            </div>
                        </div>

                        <div class="outgoing_msg">
                            <div class="sent_msg">
                                <p>Test which is a new approach to have all
                                    solutions</p>
                                  
                                <span class="time_date"> 11:01 AM | June 9</span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <form id="form" action="">
                                <input type="text" class="write_msg" placeholder="Type a message" id="input" autocomplete="off" />
                                <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        $(function() {
            // let ip_address = 'http://127.0.0.1';
            // let socket_port = '3000';
            // let socket = io(ip_address + ':' + socket_port);
            let form = document.getElementById('form');
            let input = document.getElementById('input');
            let element = document.getElementById('messagess');

            let socket = io("{{config('app.url_api')}}");
            socket.on('connection');
            var userID = "{{ Auth::user()->id }}";
            
            element.scrollTop = element.scrollHeight - element.clientHeight;
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (input.value) {  
                    var time = "{{ date('h:ia | d/m/y') }}";   
                    $("#messagess").append("<div class='outgoing_msg'><div class='sent_msg'><p>"+input.value+"</p><span class='time_date'> "+time+"</span></div></div>");           
                    element.scrollTop = element.scrollHeight - element.clientHeight;
                    socket.emit('sendChatToServer',{ id_user: userID, input: input.value,time: time});
                    input.value = '';
                    return false;
                }
            });

            socket.on('sendChatToClient', function(msg) {
                
                if(msg.id_user != userID){
                    $("#messagess").append("<div class='incoming_msg'><div class='incoming_msg_img'> <img src='https://ptetutorials.com/images/user-profile.png' alt='sunil'> </div><div class='received_msg'><div class='received_withd_msg'><p>"+msg.input+"</p><span class='time_date'> "+msg.time+"</span></div></div></div>");
                }
            });

            socket.on('live-user',function(msg){
                $('#msg').text(msg.msg);
            });

            socket.on('noti',function(msg){
                // $('#noti').append(msg.msg + '<br>');
                $('#noti').text(msg.msg);
            });

        });
    </script>
</body>
<!-- https://freetuts.net/broadcasting-trong-socketio-2255.html -->
</html>

<!-- // $("body").append(html) -->

<!-- $(document).ready(function() {
    $("select[name='product_id']").on("change", function() {
      var productID = $(this).val();
      if(productID) {
      $.ajax({
        url: "{{ url("admin/getProductInfo") }}/"+encodeURI(productID),
        type: "GET",
        dataType: "json",
        success:function(data) {
        $(".stock").empty();
        $.each(data, function(key, value) {
            $(".stock").append("<input type='text' class='form-control' value='"+value['stock']+"' name='stock' disabled>");
            });
        }
      }); //ajax
      }else{
        $(".stock").empty().append("<input type='text' value='' class='form-control' name='stock' disabled>");
      }
    });
  }); -->