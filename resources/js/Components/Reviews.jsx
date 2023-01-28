import { Box, Badge, Text, Divider, Center, Stack, Flex, Image, Tabs, TabList, TabPanels, Tab, TabPanel, Input, Select, Button, Heading, Grid, GridItem } from '@chakra-ui/react'
import ReviewCard from './ReviewCard'
import { useColorModeValue } from '@chakra-ui/color-mode'

const Reviews = (props) => {
	const bg = useColorModeValue('gray.50', 'gray.700')
	const reviews = props.data
		
	return (
		<>
			<Grid templateColumns={{ base: 'repeat(2, 1fr)', md: 'repeat(3, 1fr)', lg: 'repeat(4, 1fr)' }} gap={5}>
				{reviews && reviews.map((data, i) => (
					<GridItem key={i}>
						<ReviewCard review={data} margin={'0'} />
					</GridItem>
				))}
			</Grid>
		</>
		)
	}
	
export default Reviews