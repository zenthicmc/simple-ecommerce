import main from '../Styles/main.module.css'
import Header from '@/Components/Header'
import Footer from '@/Components/Footer'
import { Badge, Box, Button, CardBody, Flex, Grid, Image, Text, Card, Divider } from '@chakra-ui/react'
import { HiShoppingCart } from 'react-icons/hi';
import { AiFillStar } from 'react-icons/ai';
import Increament from '@/Components/Increament';
import { useColorModeValue } from '@chakra-ui/color-mode'

const Detail = (props) => {
	const product = props.product
	const bg = useColorModeValue('gray.50', 'gray.700')
	
	return (
		<div className={main.container}>
			<Header merchant={props.merchant} />
			<Grid templateColumns={{ base: 'repeat(1, 1fr)', md: 'repeat(1, 1fr)', lg: 'repeat(2, 1fr)' }} marginTop='10' gap={'6'}>
				<Card w={{ base: '100%', md: '100%', lg: '43rem' }} bg={bg} variant={'outline'} px={'3'} py={'2'}>
					<CardBody>
						<Text fontSize={'2xl'} fontWeight={'600'}>{product.name.toUpperCase()}</Text>
						<Flex alignItems={'center'} marginTop={'2'}>
							<Text fontSize={'sm'} fontWeight={'300'}>Product sold {props.count_transactions} times</Text>
							<Text mx={'3'}>•</Text>
							<Flex alignItems='center'>
								<Text fontSize='sm' fontWeight='500' marginRight='2' marginTop={0.5}>{props.count_star}</Text>
								{ props.count_star > 0 ?
									[...Array(5)].map((star, i) => {
										const ratingValue = i + 1
										return (
											<AiFillStar key={i} color={ratingValue <= props.count_star ? 'orange' : '#e4e5e9'} />
										)
									}) : 'no review yet'
								}
								<Text fontSize='sm' fontWeight='300' marginLeft='2'>({props.count_review} reviews)</Text>
							</Flex>
						</Flex>
						<Divider my={'5'}/>
						<Image 
							src={'/product-images/' + product.image} 
							borderRadius='lg'
							width='80%'
							height={{ base: '180', md: '250', lg: '320' }}
							m={'auto'}
							alt={product.name}
						/>

						<Text fontSize={'sm'} marginTop={'5'}>
							<div dangerouslySetInnerHTML={{ __html: product.description }} />
						</Text>
					</CardBody>
				</Card>
				<Flex direction={'column'} w={'100%'} h={'100%'} gap={'5'}>
					<Card w={'100%'} h={'280'} bg={bg} variant={'outline'} px={'3'} py={'2'}>
						<CardBody>
							<Text fontSize={'lg'} fontWeight={'600'} marginBottom={'5'}>🛒 Purchase</Text>
							<Increament stock={props.count_stocks} data={props.stocks} price={product.price} id={product.id} />
						</CardBody>
					</Card>
					<Card w={'100%'} h={'340'} bg={bg} variant={'outline'} px={'3'} py={'2'}>
						<CardBody>
							<Text fontSize={'lg'} fontWeight={'600'} marginBottom={'5'}>✅ Warranty</Text>
							<Text fontSize={'sm'} fontWeight={'300'}>
								1. SEMUA BARANG YANG SUDAH DIBELI DAN SUDAH DIPAKAI TIDAK DAPAT DI REFUND<br />
								2. JIKA PRODUK YANG DITERIMA TIDAK  BISA DIGUNAKAN KAMI AKAN MEMBERIKAN GARANSI<br />
								3. JIKA BUTUH BANTUAN BISA JOIN DISCORD KAMI https://discord.gg/kzone UNTUK MENDAPAT SUPPORT LEBIH LANJUT<br />
								4. JIKA ADA PERTANYAAN BISA JOIN DISCORD KAMI https://discord.gg/kzone
							</Text>
						</CardBody>
					</Card>
				</Flex>
			</Grid>
			<Footer merchant={props.merchant} />
		</div>
	)
}

export default Detail