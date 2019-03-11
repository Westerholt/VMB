import React from 'react';
import ReactDOM from 'react-dom';
import './css/index.css';
import Nav from './Nav';
import Sect1 from './Sect1';
import Sect2 from './Sect2';

class Main extends React.Component{
    render(){
        return(
            <div className="root">
                <Nav />
                <Sect1 />
                <Sect2 />
            </div>
        );
    }
}

ReactDOM.render(<Main />, document.getElementById('root'));