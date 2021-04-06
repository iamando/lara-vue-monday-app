<template>
  <div id="right">
    <div class="heading-task">
      <div>
        <h1 class="app-title">MONDAY</h1>
        <div class="horizontal">
          <img src="images/horizontal.png" alt="" />
        </div>
      </div>
      <div class="user-image-container">
        <button class="user-button-logout" @click="logoutUser">Logout</button>
      </div>
    </div>
    <div class="upcoming">
      <div class="add-tasks">
        <h2>Today's Task</h2>
        <div class="add-action">
          <img src="images/add.png" alt="" />
        </div>
      </div>
      <ul class="tasks-list">
        <li v-for="task in todayTasks" v-bind:key="task.id">
          <div class="info">
            <div class="left">
              <label class="myCheckbox">
                <input
                  type="checkbox"
                  name="test"
                  :checked="task.completed"
                  @change="removeTodayTask(task.taskId)"
                />
                <span></span>
              </label>
              <span>
                <span
                  v-if="
                    isTodayEditable == false || isTodayEditable != task.taskId
                  "
                >
                  <h4>{{ task.title }}</h4>
                </span>
                <input
                  v-if="isTodayEditable == task.taskId"
                  type="text"
                  v-model="newTodayEdit"
                  name="newTodayEdit"
                  placeholder="Edit your today task..."
                  class="editUpcomingTask"
                />
              </span>
            </div>
            <div class="right">
              <img
                v-if="
                  isTodayEditable == false || isTodayEditable != task.taskId
                "
                v-on:click="isTodayEditable = task.taskId"
                src="images/edit.png"
                alt=""
              />
              <img
                v-if="isTodayEditable == task.taskId"
                v-on:click="updateTodayTask(task.id)"
                src="images/check.png"
                alt=""
              />
              <img
                src="images/del.png"
                alt=""
                @click="deleteTodayTask(task.taskId)"
              />
              <button
                v-bind:class="{
                  inprogress: !task.approved,
                  approved: task.approved,
                }"
              >
                {{ task.approved ? "Approved" : "In progress" }}
              </button>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="upcoming">
      <div class="add-tasks">
        <h2>Upcoming</h2>
        <div class="add-action">
          <img src="images/add.png" alt="" />
        </div>
      </div>
      <form action="" @submit="addUpcomingTask">
        <input
          type="text"
          name="newTask"
          v-model="newTask"
          class="upcoming-input"
          placeholder="Enter your new upcoming task here..."
          required
        />
      </form>
      <ul class="tasks-list">
        <li v-for="upcomingtask in upcoming" v-bind:key="upcomingtask.id">
          <div class="info">
            <div class="left">
              <label class="myCheckbox">
                <input
                  type="checkbox"
                  name="test"
                  :checked="upcomingtask.completed"
                  @change="checkUpcoming(upcomingtask.taskId)"
                />
                <span></span>
              </label>
              <span>
                <span
                  v-if="
                    isUpcomingEditable == false ||
                    isUpcomingEditable != upcomingtask.taskId
                  "
                  ><h4>{{ upcomingtask.title }}</h4>
                </span>
                <input
                  v-if="isUpcomingEditable == upcomingtask.taskId"
                  type="text"
                  v-model="newTaskEdit"
                  name="newTask"
                  placeholder="Edit your upcoming task..."
                  class="editUpcomingTask"
                />
              </span>
            </div>
            <div class="right">
              <img
                v-if="
                  isUpcomingEditable == false ||
                  isUpcomingEditable != upcomingtask.taskId
                "
                src="images/edit.png"
                alt=""
                v-on:click="isUpcomingEditable = upcomingtask.taskId"
              />
              <img
                v-if="isUpcomingEditable == upcomingtask.taskId"
                src="images/check.png"
                alt=""
                v-on:click="updateUpcomingTask(upcomingtask.id)"
              />
              <img
                src="images/del.png"
                alt=""
                @click="delUpcoming(upcomingtask.taskId)"
              />
              <button class="inprogress">Waiting</button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { v4 as uuidv4 } from "uuid";
import axios from "axios";
export default {
  data() {
    return {
      todayTasks: [],
      upcoming: [],
      newTask: "",
      isUpcomingEditable: false,
      isTodayEditable: false,
      newTodayEdit: "",
      newTaskEdit: "",
      user: {},
    };
  },

  created() {
    this.fetchCurrentUser();
    this.fetchTodayTasks();
    this.fetchUpcoming();
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
    /**
     * Logout user
     */
    logoutUser() {
      axios.post("/logout").then((res) => {
        window.location.reload();
        return false;
      });
    },

    //** Upcoming task */
    /**
     * Get upcoming tasks
     */
    fetchUpcoming() {
      fetch("/upcoming")
        .then((res) => res.json())
        .then(({ data }) => {
          this.upcoming = data;
        })
        .catch((err) => console.log(err));
    },
    /**
     * Add upcoming task
     */
    addUpcomingTask(e) {
      e.preventDefault();
      if (this.upcoming.length >= 4) {
        alert("Please complete the upcoming task");
      } else {
        const newTask = {
          title: this.newTask,
          waiting: true,
          taskId: uuidv4(),
          user_id: this.user.id,
        };
        fetch("/api/upcoming", {
          method: "POST",
          headers: {
            "content-type": "application/json",
          },
          body: JSON.stringify(newTask),
        }).then(() => this.upcoming.push(newTask));
        this.newTask = "";
      }
    },
    /**
     * Check upcoming task
     */
    checkUpcoming(taskId) {
      if (this.todayTasks.length >= 4) {
        alert("Sorry completed existing task");
        window.location.href = "/";
      } else {
        this.addDailyTask(taskId);
        fetch(`/api/upcoming/${taskId}`, {
          method: "DELETE",
        }).then(() => {
          this.upcoming = this.upcoming.filter(
            ({ taskId: id }) => id !== taskId
          );
        });
      }
    },
    /**
     * Update upcoming task
     */
    updateUpcomingTask(id) {
      const newTaskEdit = {
        title: this.newTaskEdit,
      };
      fetch(`/api/upcoming/${id}`, {
        method: "PUT",
        headers: {
          "content-type": "application/json",
        },
        body: JSON.stringify(newTaskEdit),
      })
        .then(() => this.fetchUpcoming())
        .catch((err) => console.log(err));
      this.newTaskEdit = "";
      this.isUpcomingEditable = false;
    },
    /**
     * Delete upcoming
     */
    delUpcoming(taskId) {
      if (confirm("Are you sure ?")) {
        fetch(`/api/upcoming/${taskId}`, {
          method: "DELETE",
        })
          .then((res) => res.json())
          .then((data) => {
            this.upcoming = this.upcoming.filter(
              ({ taskId: id }) => id !== taskId
            );
          })
          .catch((err) => console.log(err));
      }
    },

    //** Today task */
    /**
     * Get today tasks
     */
    fetchTodayTasks() {
      fetch("/dailytask")
        .then((res) => res.json())
        .then(({ data }) => (this.todayTasks = data))
        .catch((err) => console.log(err));
    },
    /**
     * Add daily task
     */
    addDailyTask(taskId) {
      let task = this.upcoming.filter(({ taskId: id }) => id == taskId)[0];
      task.user_id = this.user.id;
      fetch("/api/dailytask", {
        method: "POST",
        headers: {
          "content-type": "application/json",
        },
        body: JSON.stringify(task),
      })
        .then(() => this.todayTasks.unshift(task))
        .catch((err) => console.log(err));
    },
    /**
     * Update today task
     */
    updateTodayTask(id) {
      const newTodayEdit = {
        title: this.newTodayEdit,
      };
      fetch(`/api/dailytask/${id}`, {
        method: "PUT",
        headers: {
          "content-type": "application/json",
        },
        body: JSON.stringify(newTodayEdit),
      })
        .then(() => this.fetchTodayTasks())
        .catch((err) => console.log(err));
      this.newTodayEdit = "";
      this.isTodayEditable = false;
    },
    /**
     * Remove today task
     */
    removeTodayTask(taskId) {
      if (confirm("Task Complted ?")) {
        fetch(`/api/dailytask/${taskId}`, {
          method: "DELETE",
        })
          .then((res) => res.json())
          .then((data) => {
            this.todayTasks = this.todayTasks.filter(
              ({ taskId: id }) => id !== taskId
            );
          })
          .catch((err) => console.log(err));
      }
    },
    /**
     * Delete today task
     */
    deleteTodayTask(taskId) {
      if (confirm("Are you sure ?")) {
        fetch(`/api/dailytask/${taskId}`, {
          method: "DELETE",
        })
          .then((res) => res.json())
          .then((data) => {
            this.todayTasks = this.todayTasks.filter(
              ({ taskId: id }) => id !== taskId
            );
          })
          .catch((err) => console.log(err));
      }
    },
  },
};
</script>

<style>
</style>
