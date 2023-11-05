import { Box, Badge, Text, Image, Flex } from '@chakra-ui/react'
import { AiFillStar } from 'react-icons/ai'
import { useColorModeValue } from '@chakra-ui/color-mode'
import LogoPrio from '../Assets/logo-piro.png'

const About = (props) => {
	const bg = useColorModeValue('gray.50', 'gray.700')
	
	return (
        <Box
            bg={bg}
            w="100%"
            p="5"
            borderRadius="md"
            borderWidth="1px"
            marginTop={10}
        >
            <Flex
                justifyContent="space-around"
                alignItems=""
                direction={{ base: "column", md: "column", lg: "row" }}
            >
                <Box>
                    <Image
                        src={LogoPrio}
                        alt="store"
                        width="70"
                        height="70"
                        borderRadius="sm"
                    />
                </Box>
                <Box
                    marginLeft={{ base: "0", lg: "0.5rem" }}
                    marginTop={{ base: "3" }}
                >
                    <Badge
                        colorScheme="teal"
                        paddingStart="2"
                        paddingEnd="2"
                        paddingTop={1}
                        paddingBottom={1}
                        borderRadius="sm"
                    >
                        {props.merchant}
                    </Badge>
                    <Text fontSize="sm" fontWeight="300" marginTop={2}>
                        Providing customer services since November 2022
                    </Text>
                </Box>
                <Box
                    marginLeft={{ base: "0", lg: "10%" }}
                    marginTop={{ base: "3" }}
                >
                    <Text fontSize="md" fontWeight="400">
                        📊 Products Sold
                    </Text>
                    <Text fontSize="md" fontWeight="500" marginTop={2}>
                        {props.count}
                    </Text>
                </Box>
                <Box
                    marginLeft={{ base: "0", lg: "10%" }}
                    marginTop={{ base: "3" }}
                >
                    <Text fontSize="md" fontWeight="400">
                        🙂 Product Quality
                    </Text>
                    <Flex alignItems="center" marginTop={2}>
                        <Text
                            fontSize="md"
                            fontWeight="500"
                            marginRight="2"
                            marginTop={0.5}
                        >
                            {props.avg_review}
                        </Text>
                        {[...Array(5)].map((star, i) => {
                            const ratingValue = i + 1;
                            return (
                                <AiFillStar
                                    key={i}
                                    color={
                                        ratingValue <= props.avg_review
                                            ? "orange"
                                            : "#e4e5e9"
                                    }
                                />
                            );
                        })}
                        <Text fontSize="sm" fontWeight="300" marginLeft="2">
                            ({props.count_review} reviews)
                        </Text>
                    </Flex>
                </Box>
            </Flex>
        </Box>
    );
}

export default About