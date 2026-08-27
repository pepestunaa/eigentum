import React from 'react';
import * as stylex from '@stylexjs/stylex';
import { motion } from 'framer-motion';
import { colors, typography, spacing, layout } from '../tokens.stylex';

const styles = stylex.create({
    card: {
        display: 'flex',
        flexDirection: 'column',
        gap: spacing.sm,
        padding: spacing.lg,
        borderTop: `1px solid ${colors.lineLight}`,
        position: 'relative',
        transition: 'background-color 0.3s ease',
        ':hover': {
            backgroundColor: 'rgba(0,0,0,0.02)',
        },
    },
    meta: {
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'baseline',
    },
    index: {
        fontFamily: typography.fontMono,
        fontSize: '0.875rem',
        color: colors.accentLight,
        fontWeight: typography.weightBold,
    },
    axis: {
        fontFamily: typography.fontMono,
        fontSize: '0.75rem',
        color: colors.lineLight,
        letterSpacing: '0.04em',
    },
    title: {
        fontFamily: typography.fontDisplay,
        fontSize: typography.step2,
        fontWeight: typography.weightMedium,
        color: colors.inkDark,
        margin: 0,
        lineHeight: 1.1,
    },
    desc: {
        fontFamily: typography.fontBody,
        fontSize: '1rem',
        color: colors.inkDark,
        opacity: 0.7,
        maxWidth: '60ch',
        lineHeight: 1.5,
    }
});

interface CardProps {
    index: string;
    title: string;
    description: string;
    axis?: string;
}

export default function Card({ index, title, description, axis }: CardProps) {
    return (
        <motion.div 
            whileHover={{ y: -4 }}
            transition={{ type: 'spring', stiffness: 300, damping: 20 }}
            {...stylex.props(styles.card)}
        >
            <div {...stylex.props(styles.meta)}>
                <span {...stylex.props(styles.index)}>{index}</span>
                {axis && <span {...stylex.props(styles.axis)}>{axis}</span>}
            </div>
            <h3 {...stylex.props(styles.title)}>{title}</h3>
            <p {...stylex.props(styles.desc)}>{description}</p>
        </motion.div>
    );
}
