import { Card, CardHeader, CardBody, CardFooter, ButtonGroup, Button, Heading, Stack, Divider, Text, Image } from '@chakra-ui/react'
import { Link } from '@inertiajs/inertia-react';
import { useColorModeValue } from '@chakra-ui/color-mode'

const sanitize = (str) => {
	const string = str.replace(/<\/?[^>]+(>|$)/g, "")
	const new_string = string.replace(/&nbsp;/g, " ").substring(0, 50) + '...'
	return new_string
}

const ProductCard = ({ data }) => {
	const bg = useColorModeValue('gray.50', 'gray.700')
	const color = useColorModeValue('teal.600', 'teal.100')

	return (
		<Link href={route('detail', data.slug)}>
			<Card 
				maxW='100%'
				minH={'100%'}
				variant='outline' 
				bg={bg}
				_hover={
					{
						boxShadow: 'lg',
						transform: 'translateY(-2px)',
						transition: 'all 0.2s ease-in-out'
					}
				}>	
				<CardBody>
					<Image
						src={'/product-images/' + data.image}
						borderRadius='lg'
						width={{ base: '50%', md: '100%', lg: '100%' }}
						height={{ base: '130', md: '130', lg: '140' }}
						alt={data.name}
						margin={'auto'}
					/>
					<Stack mt='4' spacing='2'>
						<Text size='sm' fontWeight={'500'} textTransform="capitalize">{data.name}</Text>
						<Text fontSize='sm'>
							{sanitize(data.description)}
						</Text>
						<Text color={color} fontSize='md'>
							Rp { data.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }
						</Text>
					</Stack>
				</CardBody>
			</Card>
		</Link>
	)
}

export default ProductCard