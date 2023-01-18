import main from '../Styles/main.module.css'
import { Box, Badge, Text, Divider, Center, Stack, Flex, Image, Tabs, TabList, TabPanels, Tab, TabPanel, Input, Select, Button, Heading, Grid, GridItem } from '@chakra-ui/react'
import { AiFillStar } from 'react-icons/ai'
import ProductCard from '@/Components/ProductCard'
import About from '@/Components/About'
import Header from '@/Components/Header'
import Footer from '@/Components/Footer'
import Products from '@/Components/Products'
import Reviews from '@/Components/Reviews'
import { useColorModeValue } from '@chakra-ui/color-mode'

const Home = (props) => {
	return (
		<div className={main.container}>
			<Header merchant={props.merchant} />
			<About merchant={props.merchant} count={props.count_transactions} avg_review={props.average_review} count_review={props.count_review}/>

			<Tabs colorScheme='teal' marginTop='10' w={'100%'}>
				<TabList>
					<Tab fontSize='sm'>📦 Products</Tab>
					<Tab fontSize='sm'>📞 Contact</Tab>
					<Tab fontSize='sm'>⭐ Feedback</Tab>
					<Tab fontSize='sm'>📝 Terms</Tab>
				</TabList>

				<TabPanels>
					<TabPanel p={0}>
						<Products data={props.products} />
					</TabPanel>
					<TabPanel p={0}>
						<Flex alignItems='center' marginTop='5'>
							<p>Contact</p>
						</Flex>
					</TabPanel>
					<TabPanel p={0}>
						<Flex alignItems='center' marginTop='5'>
							<Reviews data={props.reviews} />
						</Flex>
					</TabPanel>
					<TabPanel p={0}>
						<Flex alignItems='center' marginTop='5'>
							<p>Terms</p>
						</Flex>
					</TabPanel>
				</TabPanels>
			</Tabs>

			<Footer merchant={props.merchant} />
		</div>
	)
}

export default Home