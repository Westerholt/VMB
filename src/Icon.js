import React from 'react';

class Icon extends React.Component{
    render(){
        return(
            <div className={`icon ${ this.props.val }`}></div>
        );
    }
}

export default Icon