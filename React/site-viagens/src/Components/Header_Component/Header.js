import React, { Component } from 'react'
import './Header.sass';

export default class Header extends Component {

    constructor( props ){
        super(props);
        
        this.state = {
            
        }
    }

alerta(){
    return alert('teste alerta')
}
    render() {
        return (
        <div>
            <button type="button"
                className="btn btn-info"
                onClick={ ()=> 
                    this.alerta }>teste alert
            </button>
            <button type="button" className="btn-primary"> teste2</button>
        </div>
        )
    }
}
