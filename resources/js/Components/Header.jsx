import { ReactNode } from 'react';
import {
	Box,
	Flex,
	useColorModeValue,
	Stack,
	useColorMode,
	Center,
	Text,
	Divider,
	Button
} from '@chakra-ui/react';
import { BsFillSunFill, BsFillMoonFill } from 'react-icons/bs';
import { Link } from '@inertiajs/inertia-react';

export default function Header(props) {
  	const { colorMode, toggleColorMode } = useColorMode();

  	return (
		<>
			<Box>
				<Flex alignItems={'center'} justifyContent={'space-between'} my={'3'}>
					<Box>
						<Link href='/'>
							<Text fontSize='lg' fontWeight='600'>{props.merchant}</Text>
						</Link>
					</Box>

					<Flex alignItems={'center'}>
						<Stack direction={'row'} spacing={7}>
							<Button onClick={toggleColorMode}>
								{colorMode === 'light' ? <BsFillMoonFill /> : <BsFillSunFill />}
							</Button>
						</Stack>
					</Flex>
				</Flex>
			</Box>
			<Divider />
		</>
  	);
}