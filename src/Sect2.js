import React from 'react';
import Features from './Features.js';
import $ from 'jquery';

class Sect2 extends React.Component{
    handleClick=()=>{
            $('#modalWindow').css('display', 'block');
    }
    
    render(){
        return(
            <section className="section2">
                <h1>OUR ADVANTAGES</h1>
                <Features />
                <div className="butCont">
                    <button className="book" id="bookNow" onClick={()=>this.handleClick()}>book now</button>
                </div>
            </section>
        );
    }
}

export default Sect2