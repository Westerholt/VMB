import React from 'react';
import Icon from './Icon.js';

class Features extends React.Component{
    render(){
        return(
            <div className="container">
                <div className="col"> {/* LEFT COLUMN */}
                    <div className="feature">
                        <Icon val="stopwatch" />
                        <div className="desc">Fast booking</div>
                    </div>
                    <div className="feature">
                        <Icon val="wallet" />
                        <div className="desc">Budget saving</div>
                    </div>
                    <div className="feature">
                        <Icon val="star" />
                        <div className="desc">A lot of classes</div>
                    </div>
                </div>
                <div className="col"> {/* RIGHT COLUMN */}
                    <div className="feature">
                        <Icon val="service" />
                        <div className="desc">Perfect service</div>
                    </div>
                    <div className="feature">
                        <Icon val="add" />
                        <div className="desc letsp">Additional services</div>
                    </div>
                    <div className="feature">
                        <Icon val="loyal" />
                        <div className="desc">Loyalty programs</div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Features