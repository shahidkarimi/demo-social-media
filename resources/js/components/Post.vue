<template>
  <div class="card feed-post">
    <div class="card-header container-fluid">
      <div class="row">
        <div class="col-md-10">
          <b><a :href="post.user.profileUrl">{{post.user.name}}</a></b>
          <span class="the-time">{{
            post.created_at | moment("from", "now")
          }}</span>
        </div>
        <div class="col-md-2 action-col float-right">
          <div class="dropdown" v-if="user.id == post.created_by">
            <button
              class="btn dropdown-toggle btn-context"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              ...
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Edit</a>
              <a
                @click="deletePost(post.id, index)"
                class="dropdown-item"
                href="javascript:void(0)"
                >Delete</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body feed-body"><a class="post-body" :href="post.postUrl">{{ post.body }}</a></div>
    <div class="card-footer">
      <div class="row">
        <div class="col-md-2">
          <like-button type="post" :source_id="post.id" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import LikeButton from './LikeButton.vue';
export default {
  components: { LikeButton },
  props: ["post", "index"],
  data(){
    return {
      user: userData
    }
  },
  methods: {
    deletePost(id, index) {
      axios.delete("/post/" + id).then((response) => {
        this.$emit('post-deleted',index);
      });
    },
  },
};
</script>
<style lang="scss">
.post-body{
  color: #000000;
}
.post-body:hover{
  text-decoration: none;
  color: #000000;
}
.feed-body:hover{
  background-color: blue($color: #f4ebff);
}
</style>