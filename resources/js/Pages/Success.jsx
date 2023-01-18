import main from '../Styles/main.module.css'
import Header from '@/Components/Header'
import Footer from '@/Components/Footer'
import { Box, Button, Center, Text } from '@chakra-ui/react'
import { useColorModeValue } from '@chakra-ui/color-mode'
import { Player, Controls } from '@lottiefiles/react-lottie-player';
import { Link } from '@inertiajs/inertia-react'

const Success = (props) => {
	const bg = useColorModeValue('gray.50', 'gray.700')

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
					<Center marginBottom={'10'} w={'100%'}>
						<Link href={'/'} w={'100%'}>
							<Button w={'100%'} colorScheme={'teal'} variant={'solid'}>Back to Home</Button>
						</Link>
					</Center>
				</Box>
			</Box>
			<Footer merchant={props.merchant} />
		</div>
	)
}

export default Success