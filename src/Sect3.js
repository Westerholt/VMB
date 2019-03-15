import React from 'react';
import $ from 'jquery';

class Sect3 extends React.Component{
    
    componentDidMount(){
        $("#sendCont").click(
            function(){
                if(!$("#sendCont").hasClass("animate")){
                    if ( ($("#contactName").val()=='') || ($("#contactApp").val()=='') || ($("#contactIssue").val()=='')) {
                        $("#sendCont").addClass('error');
                        $("#sendCont").addClass('animate');
                    }else{
                        var data1= {
                            name:$('#contactName').val(),
                            appId:$('#contactApp').val(),
                            issue:$('#contactIssue').val(),
                        }
                        $.ajax({
                            url: "contact.php",
                            type: "POST",
                            data: data1,
                            success: function(response) {
                                $("#sendCont").addClass('success');
                                $("#sendCont").addClass('animate');
                            },
                            error: function(response) {
                                $("#sendCont").addClass('error');
                                $("#sendCont").addClass('animate');
                
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
            <section className="section3">
                <h1>get in touch</h1>
                <div className="contS3">
                    <div className="mapCont">
                        <div className="map"></div>
                        <div className="address">N Lake St. 21, Los Angeles, CA</div>
                    </div>
                    <div className="contactCont">
                        <form method="post" id="ajax_form_contact" action="contact.php" className="formContact">
                            <input className="inContact" id='contactName' type="text" placeholder="Enter your name" name="name" required="required"/><br/><br/><br/>
                            <input className="inContact" id='contactApp' type="number" placeholder="Enter your apartment number (optional)" name="app"/><br/><br/><br/>
                            <textarea className="inContact bigIn" id='contactIssue' placeholder="Describe your issue" name="name" required="issue"></textarea>
                            <button className="button" id="sendCont">SEND</button>
                        </form>
                    </div>
                </div>
            </section>
        );
    }
}

export default Sect3