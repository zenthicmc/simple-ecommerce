import main from '../Styles/main.module.css'
import Header from '@/Components/Header'
import Footer from '@/Components/Footer'
import { Badge, Box, Button, CardBody, Flex, Grid, Image, Text, Card, Divider, Stack, Input, InputGroup, InputRightElement, InputLeftElement, InputLeftAddon, Select, Alert } from '@chakra-ui/react'
import { useColorModeValue } from '@chakra-ui/color-mode'
import { Link } from '@inertiajs/inertia-react'
import { useForm, router } from '@inertiajs/inertia-react'
import { AiOutlineStar, AiFillStar } from 'react-icons/ai';
import { useState } from 'react'

const CreateReview = (props) => {
	const bg = useColorModeValue('gray.50', 'gray.700')
	const color = useColorModeValue('gray.600', 'gray.50')
	const [star, setStar] = useState(5)
	const [isSuccess, setIsSuccess] = useState(false)
	const transaction = props.transaction

	const { data, setData, post, processing, errors } = useForm({
		id_product: transaction.id_product,
		name: transaction.name,
		star : star,
		description: "",
  	})

	function isEmpty(obj) {
		return Object.keys(obj).length === 0;
	}

	function handleStar(e) {
		setStar(e.target.id)
	}

	function handleSubmit(e) {
		e.preventDefault()
		post(`/review_store/${props.code}`, data)
	}

	const handleChange = (e) => {
		const key = e.target.id;
		const value = e.target.value
		setData(values => ({
			...values,
			[key]: value,
		}))
	}

	return (
		<div className={main.container}>
			<Header merchant={props.merchant} />
			<Box w={{ base: '100%', md: '80%', lg: '80%' }} bg={bg} variant={'outline'} py={'10'} px={{ base: '5', md: '20', lg: '20' }} m={'auto'} marginTop={'10'} borderRadius={'md'}>
				<Box alignItems={'center'}>
					<Text fontSize={'2xl'} fontWeight={'600'}>🌟 Write Your Review</Text>
					<Text fontSize={'sm'} fontWeight={'300'} marginBottom={'5'}>
						Thanks for purchasing our product. We would love to hear your feedback.
					</Text>

					<form onSubmit={handleSubmit}>
						<Stack spacing={4} my={'7'}>
							{!isEmpty(errors) &&
								<Alert status='error' borderRadius={'md'}>
									{Object.keys(errors).map((key, index) =>
										<Text key={index}>{errors[key]}</Text>
									)}
								</Alert>
							}

							{isSuccess &&
								<Alert status='success' borderRadius={'md'}>
									<Text>Your review has been submitted!</Text>
								</Alert>
							}

							<Stack direction={{ base: 'column', md: 'row' }} spacing={2}>
								{
									[...Array(5)].map((_, i) => (
										i < star ?
											<AiFillStar key={i} id={i + 1} onClick={handleStar} color={'orange'} size={30} />
										: <AiOutlineStar key={i} id={i + 1} onClick={handleStar} color={'#CBD5E0'} size={30} />
									))
								}
							</Stack>

							<Input type='text' placeholder='Enter your review...' id='description' fontSize={'md'} value={data.description} onChange={handleChange} required/>
						</Stack>

						<Button type='submit' colorScheme={'teal'} size={'md'} fontSize={'sm'} w={'100%'}>Submit</Button>
					</form>
				</Box>
			</Box>
			<Footer merchant={props.merchant} />
		</div>
	)
}

export default CreateReview