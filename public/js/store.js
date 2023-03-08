document.addEventListener("alpine:init", () => {
  Alpine.store("darkMode", {
    on: false,
    toggle() {
      this.on = !this.on;
    },
  });
});

function getLatestPost(posts) {
  return posts.slice(-1).pop();
}
