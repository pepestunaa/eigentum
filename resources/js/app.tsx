import './bootstrap';
import '@astryxdesign/core/reset.css';
import '@astryxdesign/core/astryx.css';
import '@astryxdesign/theme-neutral/theme.css';
import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Theme } from '@astryxdesign/core';
import { neutralTheme } from '@astryxdesign/theme-neutral/built';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Eigentum';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.tsx`, import.meta.glob('./Pages/**/*.tsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);
        root.render(
            <Theme theme={neutralTheme}>
                <App {...props} />
            </Theme>
        );
    },
    progress: {
        color: '#4B5563',
    },
});
