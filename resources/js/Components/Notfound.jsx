import { Box, Center, Image, Text, Card } from "@chakra-ui/react"
import { useColorModeValue } from "@chakra-ui/color-mode"
import notfound from '../Assets/notfound.svg'

const Notfound = () => {
	const bg = useColorModeValue('gray.50', 'gray.700')

	return (
		<>
			<Center>
				<Card bg={bg} py={'10'} rounded={'md'} boxShadow={'md'} w={'50%'} alignItems={'center'} textAlign={'center'} variant={'elevated'}>
					<Box fontSize={'lg'} fontWeight={'bold'} marginBottom={'10'}>
						<Image src={notfound} alt='404' width={'200'} height={'200'} borderRadius='sm' margin={'auto'} />
					</Box>
					<Text fontWeight={'600'}>Product not found</Text>
					<Text fontSize={'sm'} color={'gray.500'} fontWeight={'300'}>The product you are looking for is not available</Text>
				</Card>
			</Center>
		</>
  );
}

export default Notfound