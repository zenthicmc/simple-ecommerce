import React from 'react'
import { useNumberInput, HStack, Button, Input, Text } from '@chakra-ui/react'
import { useState } from 'react'
import { useColorModeValue } from '@chakra-ui/color-mode'
import { Link } from '@inertiajs/inertia-react';

const Increament = (props) => {
	const [stock, setStock] = useState(props.stock)
	const [price, setPrice] = useState(props.price)
	const [count, setCount] = useState(1)
	const bg = useColorModeValue('white', 'gray.600')
	const product = props.product

	const checkMinQuantity = () => {
		if(count < product.min_quantity) {
			setStock(parseInt(stock) - (product.min_quantity - count))
			setPrice(parseInt(props.price) * product.min_quantity)
			setCount(product.min_quantity)
		}
	}

	checkMinQuantity()

	const onClickIncrease = () => {
		if(count < props.stock && count) {
			setStock(parseInt(stock) - 1)
			setPrice(parseInt(props.price) + parseInt(price))
			setCount(parseInt(count) + 1)
		}
	}

	const onClickDecrease = () => {
		if(count > 1 && count > product.min_quantity) {
			setStock(parseInt(stock) + 1)
			setPrice(parseInt(price) - parseInt(props.price))
			setCount(parseInt(count) - 1)
		}
	}

	return (
		<>
			<Text>📦 Stock: {stock != 0 ? stock : 'Habis'}</Text>
			<Text>💵 Price: Rp {price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</Text>
			{product.min_quantity > 1 && <Text>✅ Min Quantity: {product.min_quantity}</Text>}
			<HStack maxW='100%' marginTop={'5'}>
				<Button onClick={() => onClickDecrease()} colorScheme={'teal'}>-</Button>
				<Input value={count} variant={'outline'} bg={bg} />
				<Button onClick={() => onClickIncrease()} colorScheme={'teal'}>+</Button>
			</HStack>
			{stock != 0 ? 
			<>
				<Link href={route('checkout', {id_product: props.id, quantity: count} )}>
					<Button colorScheme={'teal'} size={'md'} fontSize={'sm'} w={'100%'} marginTop={'5'}>Checkout</Button>
				</Link>
			</> : 
			<>
				<Button colorScheme={'teal'} size={'md'} fontSize={'sm'} w={'100%'} marginTop={'5'} disabled>Checkout</Button>
			</>
			}
		</>
	)
}

export default Increament