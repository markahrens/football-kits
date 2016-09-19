import React from 'react'
import { Link } from 'react-router'
import NavLink from './NavLink'
import { IndexLink } from 'react-router'


export default React.createClass({
  render() {
    return (
      <div>
        <h1>Football Kits</h1>
        <ul role="nav">
          <li><IndexLink to="/" activeClassName="active">Home</IndexLink></li>
          <li><NavLink to="/about">About</NavLink></li>
          <li><NavLink to="/clubs">Clubs</NavLink></li>
        </ul>

        {this.props.children}
      </div>
    )
  }
})
