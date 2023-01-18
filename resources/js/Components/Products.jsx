import { Box, Badge, Text, Divider, Center, Stack, Flex, Image, Tabs, TabList, TabPanels, Tab, TabPanel, Input, Select, Button, Heading, Grid, GridItem } from '@chakra-ui/react'
import ProductCard from '@/Components/ProductCard'
import { useEffect, useState } from 'react'
import { useColorModeValue } from '@chakra-ui/color-mode'
import Notfound from '@/Components/Notfound'
import axios from 'axios'
import ProductSkeleton from '@/Components/ProductSkeleton'

const Products = (props) => {
	const [search, setSearch] = useState('')
	const [sort, setSort] = useState('default')
	const [products, setProducts] = useState([])
	const [loading, setLoading] = useState(true)
	const bg = useColorModeValue('gray.50', 'gray.700')

	useEffect(() => {
		setLoading(true)
		const results = props.data.filter(product =>
			product.name.toLowerCase().includes(search),
			setLoading(false)
		)
		setProducts(results)
	}, [search])

	useEffect(() => {
		setLoading(true)
		const getData = async () => {
			const data = await axios.get(`/api/product/${sort}`)
			const results = Object.values(data.data.data)
			setProducts(results)
			setLoading(false)
		}
		getData()
	}, [sort])
		

	return (
		<>
			<Flex alignItems='center' marginTop='5'>
				<Input size='lg' placeholder='Search for a product...	' variant='outline' bg={bg} fontSize='sm' 
					onChange={(e) => setSearch(e.target.value)}
				/>
				<Select size='lg' variant='outline' value={sort} bg={bg} fontSize='sm' marginLeft='5' w='50%'
					onChange={(e) => setSort(e.target.value)}
				>
					<option value='default'>Sort By: Default</option>
					<option value='high'>Sort By: Lowest Price</option>
					<option value='low'>Sort By: Highest Price</option>
					<option value='popular'>Sort By: Most Popular</option>
				</Select>
			</Flex>
			
			<Divider marginTop='5' marginBottom='5'/>
			<Grid templateColumns={{ base: 'repeat(1, 1fr)', md: 'repeat(2, 1fr)', lg: 'repeat(4, 1fr)' }} gap={6}>
				{products && products.map((product, index) => (
					!loading ? <GridItem key={index}>
						<ProductCard data={product} margin={'0'} />
					</GridItem> : <GridItem key={index}>
						<ProductSkeleton />
					</GridItem>
				))}
			</Grid>
			{!loading && products.length === 0 && <Notfound />}
		</>
		)
	}
	
	export default Products