import * as stylex from '@stylexjs/stylex';

// Font fallbacks
const displayFont = '"Fraunces Variable", "Fraunces", "Georgia", serif';
const bodyFont = '"Geist", "Inter", system-ui, -apple-system, sans-serif';
const monoFont = '"Geist Mono", "SF Mono", monospace';

export const colors = stylex.defineVars({
    paperLight: '#f0ece1',
    paperDark: '#1a1814',
    inkDark: '#111111',
    inkLight: '#f8f8f8',
    accentLight: '#c0392b', // Warm red accent (if needed)
    accentDark: '#e74c3c',
    lineLight: 'rgba(0, 0, 0, 0.1)',
    lineDark: 'rgba(255, 255, 255, 0.1)',
});

export const typography = stylex.defineVars({
    fontDisplay: displayFont,
    fontBody: bodyFont,
    fontMono: monoFont,

    // Step scale
    step0: '1rem', // 16px
    step1: '1.25rem', // 20px
    step2: '1.5rem', // 24px
    step3: '2rem', // 32px
    step4: '3rem', // 48px
    step5: '4.5rem', // 72px

    weightNormal: '400',
    weightMedium: '500',
    weightBold: '700',
    weightBlack: '900',
});

export const spacing = stylex.defineVars({
    xs: '0.5rem',
    sm: '1rem',
    md: '1.5rem',
    lg: '2rem',
    xl: '4rem',
    xxl: '8rem',
});

export const layout = stylex.defineVars({
    maxWidth: '1200px',
    contentWidth: '800px',
    radiusSm: '4px',
    radiusMd: '8px',
    radiusPill: '9999px',
});
