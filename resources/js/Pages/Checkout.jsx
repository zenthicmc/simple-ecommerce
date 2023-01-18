import main from '../Styles/main.module.css'
import Header from '@/Components/Header'
import Footer from '@/Components/Footer'
import { Badge, Box, Button, CardBody, Flex, Grid, Image, Text, Card, Divider, Stack, Input, InputGroup, InputRightElement, InputLeftElement, InputLeftAddon, Select, Alert } from '@chakra-ui/react'
import { HiShoppingCart } from 'react-icons/hi';
import { AiFillStar } from 'react-icons/ai';
import { FaUser, FaPhoneAlt } from 'react-icons/fa';
import { MdEmail } from 'react-icons/md';
import Increament from '@/Components/Increament';
import { useColorModeValue } from '@chakra-ui/color-mode'
import { useForm, router } from '@inertiajs/inertia-react'
import { useState } from 'react'

const Checkout = (props) => {
	const product = props.product
	const methods = props.methods
	const bg = useColorModeValue('gray.50', 'gray.700')
	const input = useColorModeValue('white', 'gray.600')
	const color = useColorModeValue('gray.600', 'gray.50')
	const [total, setTotal] = useState(parseInt(product.price) * parseInt(props.quantity))
	const static_total = parseInt(product.price) * parseInt(props.quantity)
	const [discount, setDiscount] = useState(0)
	const [new_discount, setNewDiscount] = useState("")

	const { data, setData, post, processing, errors } = useForm({
		id_product: product.id,
		quantity: props.quantity,
		fullname: "",
		email: "",
		phone: "",
		method: "",
		total: total,
  	})

	const handleChange = (e) => {
		const key = e.target.id;
		const value = e.target.value
		setData(values => ({
			...values,
			[key]: value,
		}))
	}

	const handleSubmit = (e) => {
		e.preventDefault()
		post('/transaction', data)
	}

	const handleDiscount = () => {
		const new_total = static_total - discount > 0 ? static_total - discount : 0
		console.log(discount)

		setNewDiscount(discount)
		setTotal(new_total)
		setData(values => ({
			...values,
			total: total - discount,
		}))
	}

	function isEmpty(obj) {
		return Object.keys(obj).length === 0;
	}
	
	return (
		<div className={main.container}>
			<Header merchant={props.merchant} />
			<Grid templateColumns={{ base: 'repeat(1, 1fr)', md: 'repeat(1, 1fr)', lg: 'repeat(2, 1fr)' }} marginTop='10' gap={'6'}>
				<Card w={{ base: '100%', md: '100%', lg: '43rem' }} bg={bg} variant={'outline'} px={'3'} py={'2'}>
					<CardBody>
						<Text fontSize={'2xl'} fontWeight={'600'}>🧾 Checkout</Text>
						<Text fontSize={'sm'} fontWeight={'300'}>Please fill in the form below to complete your order.</Text>
						<form onSubmit={handleSubmit}>
							<Stack spacing={4} my={'7'}>
								{!isEmpty(errors) &&
									<Alert status='error' borderRadius={'md'}>
										{Object.keys(errors).map((key, index) =>
											<Text key={index}>{errors[key]}</Text>
										)}
									</Alert>
								}
								
								<InputGroup>
									<InputLeftElement
										pointerEvents='none'
										children={<FaUser />}
										color={color}
									/>
									<Input type='text' placeholder='Full name' id='fullname' value={data.fullname} onChange={handleChange} required/>
								</InputGroup>

								<InputGroup>
									<InputLeftElement
										pointerEvents='none'
										children={<MdEmail />}
										color={color}
									/>
									<Input type='email' placeholder='Email' id='email' value={data.email} onChange={handleChange} required />
								</InputGroup>

								<InputGroup>
									<InputLeftElement
										pointerEvents='none'
										children={<FaPhoneAlt />}
										color={color}
									/>
									<Input type='tel' placeholder='Phone Number' id='phone' value={data.phone} onChange={handleChange} required/>
								</InputGroup>

								<Select placeholder='Choose payment method' fontSize={'md'} id='method' onChange={handleChange} required>
									{methods.map((method, index) =>
										<option key={index} value={method.code}>{method.name}</option>
									)}
								</Select>

							</Stack>

							<Button type='submit' colorScheme={'teal'} size={'md'} fontSize={'sm'} w={'100%'}>Pay</Button>
						</form>
					</CardBody>
				</Card>
				
				<Flex direction={'column'} w={'100%'} h={'100%'} gap={'5'}>
					<Card w={'100%'} h={'230'} bg={bg} variant={'outline'} px={'3'} py={'2'}>
						<CardBody>
							<Text fontSize={'lg'} fontWeight={'600'} marginBottom={'5'}>💰 Detail</Text>
							<Flex direction={'row'} justifyContent={'space-between'} alignItems={'center'}>
								<Text fontSize={'sm'} fontWeight={'300'}>Product</Text>
								<Text fontSize={'sm'} fontWeight={'300'}>{product.name.toLowerCase()}</Text>
							</Flex>
							<Flex direction={'row'} justifyContent={'space-between'} alignItems={'center'} my={'1'}>
								<Text fontSize={'sm'} fontWeight={'300'}>Subtotal</Text>
								<Text fontSize={'sm'} fontWeight={'300'}>Rp {product.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</Text>
							</Flex>
							<Flex direction={'row'} justifyContent={'space-between'} alignItems={'center'}>
								<Text fontSize={'sm'} fontWeight={'300'}>Quantity</Text>
								<Text fontSize={'sm'} fontWeight={'300'}>x{props.quantity}</Text>
							</Flex>
							{new_discount > 0 &&
								<Flex direction={'row'} justifyContent={'space-between'} alignItems={'center'} my={'1'}>
									<Text fontSize={'sm'} fontWeight={'300'}>Discount</Text>
									<Text fontSize={'sm'} fontWeight={'300'}>-Rp {new_discount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</Text>
								</Flex>
							}
							<Divider my={'2'} />
							<Flex direction={'row'} justifyContent={'space-between'} alignItems={'center'}>
								<Text fontSize={'sm'} fontWeight={'600'}>Total</Text>
								<Text fontSize={'sm'} fontWeight={'600'}>Rp {total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</Text>
							</Flex>
						</CardBody>
					</Card>

					{/* <Card w={'100%'} h={'190'} bg={bg} variant={'outline'} px={'3'} py={'2'}>
						<CardBody>
							<Text fontSize={'lg'} fontWeight={'600'} marginBottom={'4'}>📑 Promo Code</Text>
							<Input type='text' placeholder='Promo Code' id='promo' bg={input} variant={'outline'} onChange={(e) => setDiscount(e.target.value)}/>
							<Button w={'100%'} colorScheme={'teal'} size={'md'} fontSize={'sm'} mt={'3'} onClick={handleDiscount}>Apply</Button>
						</CardBody>
					</Card> */}

					<Card w={'100%'} bg={bg} variant={'outline'} px={'3'} py={'2'}>
						<CardBody>
							<Text fontSize={'lg'} fontWeight={'600'} marginBottom={'4'}>❓ Information</Text>
							<Text fontSize={'sm'} fontWeight={'300'}>
								When your transaction has been verified, you will receive the product detail via email. So Please check your email frequently after paying the invoice.
							</Text>
						</CardBody>
					</Card>

				</Flex>
			</Grid>
			<Footer merchant={props.merchant} />
		</div>
	)
}

export default Checkout
