<template>
  <a href="javascript:void" @click="like"
    ><span v-if="count > 0">{{ count }}</span> <i class="fa fa-heart"></i
  ></a>
</template>
<script>
export default {
  name: "like-button",
  props: ["type", "source_id"],

  data() {
    return {
      count: 0,
    };
  },

  created() {
    this.countLikes();
  },

  methods: {
    countLikes() {
      axios
        .get(`/like/${this.type}/${this.source_id}/count`)
        .then((response) => {
          this.count = response.data.value;
        });
    },

    like() {
      axios
        .post(`/like/${this.type}/${this.source_id}/like`)
        .then((response) => {
          this.countLikes();
        });
    },
  },
};
</script>