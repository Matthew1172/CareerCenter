var start_allWork = 0;
var limit_allWork = 0;
var reachedMax_allWork = false;
function getAllEvents() {
  if (reachedMax_allWork){
    return;
  }
  start_allWork += limit_allWork;
  limit_allWork += 2;
  $.ajax({
    url: 'php/getAllEvents.php',
    method: 'POST',
    dataType: 'text',
    data: {
      getData: 1,
      start: start_allWork,
      limit: limit_allWork
    },
    success: function(response) {
      if (response == "reachedMax"){
        reachedMax_allWork = true;
      }
      else {
        $("#all-events-list-section").append(response);
      }
    }
  });
}
var start_ownWork = 0;
var limit_ownWork = 0;
var reachedMax_ownWork = false;
function getOwnEvents() {
  if (reachedMax_ownWork){
    return;
  }
  start_ownWork += limit_ownWork;
  limit_ownWork += 2;
  $.ajax({
    url: 'php/getOwnEvents.php',
    method: 'POST',
    dataType: 'text',
    data: {
      getData: 1,
      start: start_ownWork,
      limit: limit_ownWork
    },
    success: function(response) {
      if (response == "reachedMax"){
        reachedMax_ownWork = true;
      }
      else {
        $("#own-events-list-section").append(response);
      }
    }
  });
}
var start_recWork = 0;
var limit_recWork = 0;
var reachedMax_recWork = false;
function getRecEvents() {
  if (reachedMax_recWork){
    return;
  }
  start_recWork += limit_recWork;
  limit_recWork += 2;
  $.ajax({
    url: 'php/getRecEvents.php',
    method: 'POST',
    dataType: 'text',
    data: {
      getData: 1,
      start: start_recWork,
      limit: limit_recWork
    },
    success: function(response) {
      if (response == "reachedMax"){
        reachedMax_recWork = true;
      }
      else {
        $("#work-rec-list-section").append(response);
      }
    }
  });
}
var start_recJob = 0;
var limit_recJob = 0;
var reachedMax_recJob = false;
function getRecJobs() {
  if (reachedMax_recJob){
    return;
  }
  start_recJob += limit_recJob;
  limit_recJob += 2;
  $.ajax({
    url: 'php/getRecJob.php',
    method: 'POST',
    dataType: 'text',
    data: {
      getData: 1,
      start: start_recJob,
      limit: limit_recJob
    },
    success: function(response) {
      if (response == "reachedMax"){
        reachedMax_recJob = true;
      }
      else {
        $("#job-rec-list-section").append(response);
      }
    }
  });
}
var start_ownJob = 0;
var limit_ownJob = 0;
var reachedMax_ownJob = false;
function getOwnJobs() {
  if (reachedMax_ownJob){
    return;
  }
  start_ownJob += limit_ownJob;
  limit_ownJob += 2;
  $.ajax({
    url: 'php/getOwnJob.php',
    method: 'POST',
    dataType: 'text',
    data: {
      getData: 1,
      start: start_ownJob,
      limit: limit_ownJob
    },
    success: function(response) {
      if (response == "reachedMax"){
        reachedMax_ownJob = true;
      }
      else {
        $("#job-list-section").append(response);
      }
    }
  });
}
var start_announ = 0;
var limit_announ = 0;
var reachedMax_announ = false;
function getAnnouns() {
  if (reachedMax_announ){
    return;
  }
  start_announ += limit_announ;
  limit_announ += 2;
  $.ajax({
    url: 'php/getAnnouns.php',
    method: 'POST',
    dataType: 'text',
    data: {
      getData: 1,
      start: start_announ,
      limit: limit_announ
    },
    success: function(response) {
      if (response == "reachedMax"){
        reachedMax_announ = true;
      }
      else {
        $("#announ-list-section").append(response);
      }
    }
  });
}
var start_mod = 0;
var limit_mod = 0;
var reachedMax_mod = false;
function getMod() {
  if (reachedMax_mod){
    return;
  }
  start_mod += limit_mod;
  limit_mod += 2;
  $.ajax({
    url: 'php/getModEvents.php',
    method: 'POST',
    dataType: 'text',
    data: {
      getData: 1,
      start: start_mod,
      limit: limit_mod
    },
    success: function(response) {
      if (response == "reachedMax"){
        reachedMax_mod = true;
      }
      else {
        $("#mod-event-list-section").append(response);
      }
    }
  });
}

$(window).scroll(function () {
  if ($(window).scrollTop() >= $(document).height() - $(window).height() - 900)
  {
    getAllEvents();
    getOwnEvents();
    getRecEvents();
    getRecJobs();
    getOwnJobs();
    getAnnouns();
    getMod();
  }
});

$(document).ready(function() {
  getAllEvents();
  getOwnEvents();
  getRecEvents();
  getRecJobs();
  getOwnJobs();
  getAnnouns();
  getMod();
});
