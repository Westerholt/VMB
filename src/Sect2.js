import React from 'react';
import Features from './Features.js';

class Sect2 extends React.Component{
    render(){
        return(
            <section className="section2">
                <h1>OUR ADVANTAGES</h1>
                <Features />
                <div className="butCont">
                    <button className="book">book now</button>
                </div>
            </section>
        );
    }
}

export default Sect2