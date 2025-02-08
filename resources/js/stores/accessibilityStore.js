import { defineStore } from 'pinia';

export const useAccessibilityStore = defineStore('accessibility', {
    state: () => ({
        fontSize: 16, // Default font size
    }),
    actions: {
        increaseFontSize() {
            if (this.fontSize < 24) this.fontSize += 2;
        },
        decreaseFontSize() {
            if (this.fontSize > 12) this.fontSize -= 2;
        },
    },
});
