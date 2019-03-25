import React from 'react';
import $ from 'jquery';

class Modal extends React.Component{
    hide=()=>{
        $('#modalWindow').css('display', 'none');
    }
    componentDidMount(){
        
        var rto;
        var rt=$('#roomType');
        rt.on("change",function() {
            rto=$("#roomType option:selected" ).text();
            var pl=$("#places");
            switch (rto) {
                case 'Econom':
                    pl.html('<option value="12">1 room and 2 places</option><option value="13">1 room and 3 places</option>');
                    break;
                case 'Basic':
                    pl.html('<option value="12">1 room and 2 places</option><option value="24">2 rooms and 4 places</option>');
                    break;
                case 'Business':
                    pl.html('<option value="24">2 rooms and 4 places</option><option value="36">3 rooms and 6 places</option>');
                    break;    
                default:
                    break;
            }
        });
        
        $("#btn").click(
            function(){
                if(!$("#btn").hasClass("animate")){
                    var places,rooms;
                    var place =$("#places option:selected" ).val();
                    switch(place){
                        case '12':
                            places=2;
                            rooms=1;
                            break;
                        case '13':
                            places=3;
                            rooms=1;
                            break;
                        case '24':
                            places=4;
                            rooms=2;
                            break;
                        case '36':
                            places=6;
                            rooms=3;
                            break;
                        default: 
                            break;
                    }
                    if ( ($("#name").val()=='') || ($("#uname").val()=='') || ($("#password").val()=='') || ($("#roomType").val()=='') || ($("#checkIn").val()=='') || ($("#checkOut").val()=='')) {
                        $("#btn").addClass('error');
                        $("#btn").addClass('animate');
                    }else{
                        
                        var data1= {
                            name:$('#name').val(),
                            username:$('#uname').val(),
                            password:$('#password').val(),
                            sleepPlaces: places,
                            roomsAmnt: rooms,
                            apartType:$('#roomType').val(),
                            checkin:$('#checkIn').val(),
                            company:$('#company').val(),
                            checkout:$('#checkOut').val()
                        }
                        $.ajax({
                            url: "action.php",
                            type: "POST",
                            data: data1,
                            success: function(response) {
                                var data_array = $.parseJSON(response);
                                alert(data_array['uID']);
                                alert(data_array['aID']);
                                $("#btn").addClass('success');
                                $("#btn").addClass('animate');
                            },
                            error: function(response) {
                                $("#btn").addClass('error');
                                $("#btn").addClass('animate');
                
                         }
                        });
                        return false; 
                    }  
                }else{
                    alert('Вы уже отправили заявку!');
                }
            }
        );
        
    }

    render(){
        return(
            <div className="modalRoot" id="modalWindow">
                <div className="overlay">
                    <div className="modal">
                        <div className="top">
                            <button className="closeBut" onClick={()=>this.hide()}>X</button>
                        </div>
                        <div className="bottom">
                                <form method="post" id="ajax_form" className='bookForm' action="action.php">
                                    <input className="in" id='name' type="text" placeholder="Enter your name" name="name" required="required"/><br/><br/>
                                    <input className="in" id='uname' type="text" placeholder="Enter your username" name="name" required="required"/><br/><br/>
                                    <input className="in" id='password' type="password" placeholder="Enter your password" name="name" required="required"/><br/><br/>
                                    <input className="in" id='company' type="text" placeholder="Company name (optional)" name="name"/><br/><br/>

                                    <select name="rType" className='in' id="roomType" required="required">
                                        <option value="0">Select appartment type</option>
                                        <option value="econom">Econom</option>
                                        <option value="medium">Basic</option>
                                        <option value="business">Business</option>
                                    </select>
                                    <select name="places" className='in' id="places" required="required">
                                        <option value="0">Select rooms and places</option>

                                    </select>
                                    <br/><br/>
                                    <input type="date" id="checkIn" name="checkIn" className="calendar pl"/><input type="date" name="checkOut" id="checkOut" className="calendar pl ml"/><br/><br/>
                                    <button className="bookBtn" id="btn">SEND</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Modal