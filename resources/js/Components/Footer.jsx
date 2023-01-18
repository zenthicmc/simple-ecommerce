import { Box, Divider, Text, Stack } from "@chakra-ui/react"

const Footer = (props) => {
	return (
		<>
			<Box as="footer" my={'5'} marginTop={'10'}>
				<Divider />
				<Box maxW="xl" mx="auto" marginTop={'4'}>
					<Box
						as="p"
						fontSize="sm"
						textAlign="center"
						color="gray.600"
						letterSpacing="wide"
						textTransform="capitalize"
						fontWeight="400"
					>
						&copy; 2023 {props.merchant}. All rights reserved.
					</Box>
				</Box>
			</Box>
		</>
	)
}

export default Footer