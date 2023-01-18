import './bootstrap';

import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/inertia-react';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ColorModeScript } from '@chakra-ui/react'
import theme from './theme'
import { ChakraProvider } from '@chakra-ui/react'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.jsx`, import.meta.glob('./Pages/**/*.jsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render (
            <ChakraProvider>
                <ColorModeScript initialColorMode={theme.config.initialColorMode} />
                <App {...props} />
            </ChakraProvider>
        );
    },
});

InertiaProgress.init({ color: '#4B5563' });
