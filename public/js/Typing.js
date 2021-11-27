class Typing {
    constructor(linksToType) {
        this.linksToType = $(linksToType);
        this.addTyping();
    }
    addTyping() {
        var type = new Typed(this.linksToType, {
            strings: ["<h1>First sentence.</h1>", "<h1>Log in</h1>", "<h1>Manage License</h1>"],
            typeSpeed: 80,
            startDelay: 1,
            backSpeed: 40,
            loop: true,
            showCursor: false
        });
    }
}
