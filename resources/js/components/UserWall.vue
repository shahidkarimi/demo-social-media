<template>
  <div>

    <div class="card" v-if="!userId">
      <div class="card-body">
        <textarea v-model="postBody" class="form-control"></textarea> <br />
        <button @click="saveData" class="btn btn-primary pull-right">
          Post {{userId}}
        </button>
      </div>
    </div>

    <div v-if="posts != null">
      <post v-on:post-deleted="PostDeleted" v-for="(post, index) in posts.data" :key="index" :post="post" :index="index" />
    </div>
  </div>
</template>

<script>
import Post from './Post';
export default {
  props: ['userId'],
  data() {
    return {
      postBody: "",
      posts: null,
    };
  },
  components: {
    Post
  },

  mounted() {
    this.loadData();
  },

  methods: {
    saveData() {
      axios
        .post("/post", {
          body: this.postBody,
        })
        .then((response) => {
          if (this.posts == null) {
            this.posts = {
              data: [],
            };
          }
          this.posts.data.unshift(response.data);
        });
    },

    PostDeleted(index){
      this.posts.data.splice(index, 0);
    },

    loadData() {
      let url = this.userId ? '/post/'+this.userId : "/post";
      axios.get(url).then((response) => {
        this.posts = response.data;
      });
    },
  },
};
</script>
<style lang="scss">
.feed-post {
  margin-top: 10px;
}
.btn-context {
  padding: 0px !important;
}
.the-time {
  color: #807c7c;
  font-size: 11px;
  padding-left: 5px;
}
.action-col {
  text-align: right !important;
}
</style>