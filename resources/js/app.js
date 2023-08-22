import './bootstrap';
import.meta.glob([
    '../images/**',
]);

window.PortalSidebar = {
    open: false,

    init() {
        this.toggle(isDesktop() && this.getPersistentState());
        this.closeOnMobile();
    },

    toggle(newState) {
        this.open = newState;
        this.setPersistentState();
    },

    getPersistentState() {
        return localStorage.getItem('portalSidebarOpen') === 'true';
    },

    setPersistentState() {
        localStorage.setItem('portalSidebarOpen', this.open);
    },

    closeOnMobile() {
        if (!isDesktop()) this.toggle(false);
    },

    resizeHandler() {
        this.toggle(isDesktop() && this.getPersistentState());
    }
};

function isDesktop() {
    return window.matchMedia("(min-width: 1024px)").matches;
}
