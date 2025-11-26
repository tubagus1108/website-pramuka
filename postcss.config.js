import purgecss from '@fullhuman/postcss-purgecss';

export default {
    plugins: [
        purgecss.default({
            content: [
                './resources/**/*.blade.php',
                './resources/**/*.js',
                './resources/**/*.vue',
                './app/Filament/**/*.php',
            ],
            defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || [],
            safelist: {
                standard: [
                    /^slider-/,
                    /^opacity-/,
                    /^bg-gradient-/,
                    /^from-/,
                    /^via-/,
                    /^to-/,
                    /^hover:/,
                    /^focus:/,
                    /^active:/,
                    /^group-hover:/,
                ],
                deep: [
                    /filament/,
                ],
                greedy: [
                    /data-\[/,
                ],
            },
        }),
    ],
};