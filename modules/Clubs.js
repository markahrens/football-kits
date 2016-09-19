// modules/Repos.js
import React from 'react'
import { Link } from 'react-router'
import NavLink from './NavLink'




export default React.createClass({
  componentWillMount() {
    fetch('../data.json')
    .then((res) => {
      console.log(res.json());
    });
  },

  render() {
    return (
      <div>
        <h2>Clubs</h2>
        <ul>

        </ul>



        {this.props.children}
      </div>
    )
  }
})
