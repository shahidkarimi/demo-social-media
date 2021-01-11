<template>
  <div>
    <div class="card">
      <div class="card-body">
        <textarea v-model="postBody" class="form-control"></textarea> <br />
        <button @click="saveData" class="btn btn-primary pull-right">
          Post
        </button>
      </div>
    </div>

    <div v-if="posts != null">
      <div class="card feed-post" v-for="data in posts.data">
        <div class="card-header container-fluid">
          <div class="row">
            <div class="col-md-10">
              <b>Demo User</b> <span class="the-time">{{ data.created_at | moment("from", "now") }}</span>
            </div>
            <div class="col-md-2 action-col float-right">
              <div class="dropdown">
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
                  <a class="dropdown-item" href="#">Delete</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">{{ data.body }}</div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-2">
              <a href="#">Like</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      postBody: "",
      posts: null,
    };
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

    loadData() {
      axios.get("/post").then((response) => {
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
.btn-context{
  padding: 0px !important;
}
.the-time{
  color: #807c7c;
  font-size: 11px;
  padding-left: 5px;
}
.action-col{
  text-align: right !important;
}
</style>