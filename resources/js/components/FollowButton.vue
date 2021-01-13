<template>
  <button @click="followUnfollow" v-if="displayBtn" class="btn btn-primary">
    {{ displayText }}
  </button>
</template>
<script>
export default {
  props: ["userId"],
  data() {
    return {
      displayBtn: false,
      displayText: "",
      action: "follow",
    };
  },

  created() {
    axios.get("/follow-status/" + this.userId).then((response) => {
      if (response.data.status == 1) {
        this.displayText = "Following";
        this.action = "unfollow";
      } else {
        this.displayText = "Follow";
        this.action = "follow";
      }
      this.displayBtn = true;
    });
  },

  methods: {
    followUnfollow() {
      axios
        .get("/follow-unfollow/" + this.userId + "/" + this.action)
        .then((response) => {
          if (response.data.status == 1) {
            this.displayText = "Following";
            this.action = "unfollow";
          } else {
            this.displayText = "Follow";
            this.action = "follow";
          }
        });
    },
  },
};
</script>