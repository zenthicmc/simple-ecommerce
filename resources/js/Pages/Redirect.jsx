import React, { useEffect } from 'react'

const Redirect = (props) => {
	const reference = props.reference

	useEffect(() => {
		window.location.href = `https://tripay.co.id/checkout/${reference}`
	}, [])

	return (
		<>
			<p>
				Redirecting to payment page...
			</p>
		</>
	)
}

export default Redirect