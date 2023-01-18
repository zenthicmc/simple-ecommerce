import { Card, CardHeader, CardBody, CardFooter, ButtonGroup, Button, Heading, Stack, Divider, Text, Image, Flex } from '@chakra-ui/react'
import { useColorModeValue } from '@chakra-ui/color-mode'
import {	AiFillStar	} from 'react-icons/ai'

const ReviewCard = ({ review }) => {
	const bg = useColorModeValue('gray.50', 'gray.700')
	const date = new Date(review.created_at)

	const day = date.getDate()
	const month = date.toLocaleString('en-us', { month: 'short' });
	const year = date.getFullYear()
	const new_date = `${day} ${month} ${year}`

	// sensor 3 digit nama terakhir menjadi ***
	const name = review.name
	const name_length = name.length
	const name_last = name.slice(name_length - 3, name_length)
	const name_first = name.slice(0, name_length - 3)
	const new_name = name_first + '***'
	

	return (
		<Card
			maxW='100%'
			minH={'100%'}
			variant='outline'
			bg={bg}>	
			<CardBody>
				<Stack>
					<Flex direction={{ base: 'column', md: 'row', lg: 'row' }} justifyContent='space-between'>
						<Stack direction='row' spacing={0} mb={'2'}>
							{
								[...Array(review.star)].map((_, i) => (
									<AiFillStar key={i} color={'orange'} />
								))
							}
						</Stack>
						<Text fontSize='xs' fontWeight={'300'}>{new_date}</Text>
					</Flex>
					<Text fontSize='sm' fontWeight={'500'} textTransform="capitalize">{new_name}</Text>
					<Text fontSize='xs' fontWeight={'300'}>
						{review.description}
					</Text>
				</Stack>
			</CardBody>
		</Card>
	);
}

export default ReviewCard;