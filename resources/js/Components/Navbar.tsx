import React from 'react';
import * as stylex from '@stylexjs/stylex';
import { motion } from 'framer-motion';
import { colors, typography, spacing, layout } from '../tokens.stylex';

const styles = stylex.create({
    navContainer: {
        position: 'fixed',
        top: spacing.md,
        left: '50%',
        transform: 'translateX(-50%)',
        zIndex: 50,
        width: 'calc(100% - 2rem)',
        maxWidth: layout.maxWidth,
        display: 'flex',
        justifyContent: 'center',
    },
    navPill: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        backgroundColor: colors.paperLight, // Can add glassmorphism later
        padding: `${spacing.xs} ${spacing.md}`,
        borderRadius: layout.radiusPill,
        border: `1px solid ${colors.lineLight}`,
        width: '100%',
        boxShadow: '0 4px 12px rgba(0,0,0,0.05)',
    },
    logo: {
        fontFamily: typography.fontDisplay,
        fontSize: typography.step1,
        fontWeight: typography.weightBold,
        color: colors.inkDark,
        textDecoration: 'none',
        letterSpacing: '-0.03em',
    },
    links: {
        display: 'flex',
        alignItems: 'center',
        gap: spacing.md,
    },
    link: {
        fontFamily: typography.fontMono,
        fontSize: '0.875rem',
        color: colors.inkDark,
        textDecoration: 'none',
        textTransform: 'uppercase',
        letterSpacing: '0.04em',
        transition: 'color 0.2s ease',
        ':hover': {
            color: colors.accentLight,
        },
    },
});

export default function Navbar() {
    return (
        <motion.div 
            initial={{ y: -50, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            transition={{ duration: 0.6, ease: [0.16, 1, 0.3, 1] }}
            {...stylex.props(styles.navContainer)}
        >
            <nav {...stylex.props(styles.navPill)}>
                <a href="/" {...stylex.props(styles.logo)}>Eigentum</a>
                <div {...stylex.props(styles.links)}>
                    <a href="/about" {...stylex.props(styles.link)}>About</a>
                    <a href="/projects" {...stylex.props(styles.link)}>Projects</a>
                    <a href="/contact" {...stylex.props(styles.link)}>Contact</a>
                </div>
            </nav>
        </motion.div>
    );
}
