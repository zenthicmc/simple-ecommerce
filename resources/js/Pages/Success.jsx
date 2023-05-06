import main from '../Styles/main.module.css'
import Header from '@/Components/Header'
import Footer from '@/Components/Footer'
import { Box, Button, Center, Text } from '@chakra-ui/react'
import { useColorModeValue } from '@chakra-ui/color-mode'
import { Player, Controls } from '@lottiefiles/react-lottie-player';
import { Link } from '@inertiajs/inertia-react'

const sanitize = (str) => {
	const string = str.replace(/<\/?[^>]+(>|$)/g, "")
	const new_string = string.replace(/&nbsp;/g, " ")
	return new_string
}

const Success = (props) => {
	const bg = useColorModeValue('gray.50', 'gray.700')
	const transaction = props.transaction
	const stock = JSON.parse(transaction.stock)

	return (
		<div className={main.container}>
			<Header merchant={props.merchant} />
			<Box w={{ base: '100%', md: '100%', lg: '100%' }} bg={bg} variant={'outline'} py={'10'} px={{ base: '5', md: '20', lg: '20' }} m={'auto'} marginTop={'10'} borderRadius={'md'}>
				<Box alignItems={'center'} justifyContent={'center'}>
					<Player
						autoplay
						loop
						src="https://assets3.lottiefiles.com/packages/lf20_pqnfmone.json"
						style={{ height: '200px', width: '200px' }}
					>
					</Player>
					<Text fontSize={'2xl'} fontWeight={'600'} textAlign={'center'}>Thank you for your order!</Text>
					<Text fontSize={'sm'} fontWeight={'300'} textAlign={'center'} marginBottom={'5'} marginTop={'1'}>
						Your order has been received and is now being processed. Your order details will be sent to your email. Please check your email for your order details.
					</Text>
					<Text fontSize={'sm'} fontWeight={'300'} textAlign={'center'} marginBottom={'2'} marginTop={'1'}>
						Your Order Details:
					</Text>
					<Text fontSize={'sm'} fontWeight={'600'} textAlign={'center'} marginBottom={'7'} marginTop={'1'}>
						{stock && stock.map((item, i) => (
								<div key={i} dangerouslySetInnerHTML={{__html: item.content}}></div>

						))}
					</Text>
					<Center marginBottom={'10'} w={'100%'} gap={'5'}>
						<Link href={'/'} w={'100%'}>
							<Button w={'100%'} colorScheme={'teal'} variant={'solid'}>Back to Home</Button>
						</Link>

						<Link href={route('review.write', transaction.review_code)} w={'100%'}>
							<Button w={'100%'} colorScheme={'teal'} variant={'outline'}>Write Review</Button>
						</Link>
					</Center>
				</Box>
			</Box>
			<Footer merchant={props.merchant} />
		</div>
	)
}

export default Success