<template>
  <div id="left">
    <img src="images/hamburger.png" />
    <div class="profile">
      <h1>Hi {{ user.name }}</h1>
      <h2>Let's make project more amazing</h2>
    </div>
    <div class="search">
      <input type="text" placeholder="Search your project" />
      <img src="images/search.png" />
    </div>
    <div class="project">
      <h3>Projects <span>(32)</span></h3>
      <div class="projects">
        <div class="a-project">
          <div class="box-color">
            <img src="images/overlay.png" />
            <span>PT</span>
          </div>
          <h6>PHP</h6>
        </div>
        <div class="a-project">
          <div class="box-color">
            <img src="images/overlay.png" />
            <span>PT</span>
          </div>
          <h6>Ruby</h6>
        </div>
        <div class="a-project">
          <div class="box-color">
            <img src="images/overlay.png" />
            <span>PT</span>
          </div>
          <h6>Javascript</h6>
        </div>
        <div class="a-project">
          <div class="box-color">
            <img src="images/overlay.png" />
            <span>PT</span>
          </div>
          <h6>Node JS</h6>
        </div>
        <div class="a-project">
          <div class="box-color">
            <img src="images/overlay.png" />
            <span>PT</span>
          </div>
          <h6>Design</h6>
        </div>
        <div class="a-project">
          <div class="box-color plus-box">
            <img src="images/plus.png" class="plus-img" />
          </div>
          <h6>App Project</h6>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      user: {},
    };
  },

  created() {
    this.fetchCurrentUser();
  },

  methods: {
    //** User */
    /**
     * Get current user
     */
    fetchCurrentUser() {
      axios
        .get("/user")
        .then((res) => {
          this.user = res.data;
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>

<style>
</style>
