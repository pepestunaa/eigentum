# Laravel, Inertia.js, React, and StyleX Guidelines

When working on this project, ALWAYS adhere to the following best practices for the full-stack architecture:

## 1. Backend: Laravel Best Practices
- **Thin Controllers:** Keep controllers as lean as possible. Delegate validation to **Form Requests** and business logic to Action classes or Services.
- **Routing:** Do not create separate REST API endpoints for frontend consumption unless specifically requested. Use Inertia routing. Responses should almost always be `Inertia::render('Page/Component', $data)` or redirects.
- **Modern PHP:** Use modern PHP syntax (typed properties, match expressions, constructor property promotion, nullsafe operators).
- **Testing:** Prioritize Pest PHP or modern PHPUnit for writing backend tests. 

## 2. Frontend: React 19 + Inertia
- **Functional Components:** Always use React functional components with Hooks. Do not use class components.
- **Types:** The project uses TypeScript for the frontend (`@types/react`). Make sure to type props and state correctly.
- **State Management:** Rely on Inertia's page props for server-to-client state hydration.
- **Forms:** Use Inertia's `useForm` hook for form submissions to automatically handle validation errors, processing states, and data resetting.
- **Link Component:** Always use Inertia's `<Link>` component for internal navigation to ensure single-page application (SPA) behavior without full page reloads.

## 3. Styling: StyleX & AstryxDesign
- **No Tailwind CSS:** This project uses **StyleX** (`@stylexjs/stylex`) and **AstryxDesign** (`@astryxdesign/*`). Do NOT use Tailwind CSS utility classes.
- **Style Definitions:** Define styles using `stylex.create({})` outside the component body to ensure they are compiled statically.
- **Applying Styles:** Apply styles using `stylex.props(styles.yourStyle)` on React elements.
- **Design System:** Utilize tokens and themes from `@astryxdesign/core` and `@astryxdesign/theme-neutral` for consistent spacing, colors, and typography.
- **Inline Styles:** Never use inline styles (`style={{...}}`) unless for dynamic values that cannot be resolved at build time. For animations, you may use `framer-motion` properties.

## 4. Code Generation & Refactoring Rules
- **No Hallucinations:** Do not guess database schemas. Use codebase memory or introspection to verify columns before writing queries.
- **Component Reusability:** When building new UI elements, check if a similar component already exists. If not, extract reusable elements into small, focused React components.
