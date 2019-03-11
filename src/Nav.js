import React from 'react';

class Nav extends React.Component{
    render(){
        return(
            <nav>
                <div className="logoTop"></div>
                <div className="menu">
                    <a href="">home</a>
                    <a href="">contact</a>
                    <a href="">other</a>
                </div>
            </nav>
        );
    }
}

export default Nav