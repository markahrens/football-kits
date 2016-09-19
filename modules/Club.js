import React from 'react'

export default React.createClass({
  render() {
    return (
      <div>
        <h2>{this.props.params.countryCode} - {this.props.params.clubSlug}</h2>
      </div>
    )
  }
})
