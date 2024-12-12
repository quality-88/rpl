$(document).ready(function() {
    $('#myTable').DataTable();
});


$('.__session_delete_data').click(function() {

    const __Slugs = $(this).attr('__slugs');
    const __Url = $(this).attr('__url');

    swal({
            title: "Informasi",
            text: "" + __Slugs + " ?",
            icon: "warning",
            buttons: {
                confirm: {
                    text: 'Hapus',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        })
        .then((Hapus) => {
            if (Hapus) {
                window.location.replace(
                    '' + __Url + ''
                );
            } else {
                swal("Batal Hapus Data !", {
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    },
                });
            }
        })

});

$('.__session_active_data').click(function() {

    const __Id = $(this).attr('__id');
    const __Slugs = $(this).attr('__slugs');
    const __Url = $(this).attr('__url');

    swal({
            title: "Information",
            text: "Are you sure you want to active " + __Slugs + " ?",
            icon: "info",
            buttons: {
                confirm: {
                    text: 'Active',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        })
        .then((Active) => {
            if (Active) {
                window.location.replace(
                    '' + __Url + ''
                );
            } else {
                swal("Cancel To Active Data !", {
                    buttons: {
                        confirm: {
                            className: 'btn btn-warning'
                        }
                    },
                });
            }
        })

});

$('.__session_nonactive_data').click(function() {

    const __Id = $(this).attr('__id');
    const __Slugs = $(this).attr('__slugs');
    const __Url = $(this).attr('__url');

    swal({
            title: "Information",
            text: "Are you sure you want to non active " + __Slugs + " ?",
            icon: "info",
            buttons: {
                confirm: {
                    text: 'Non Active',
                    className: 'btn btn-warning'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        })
        .then((NonActive) => {
            if (NonActive) {
                window.location.replace(
                    '' + __Url + ''
                );
            } else {
                swal("Cancel To Non Active Data !", {
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    },
                });
            }
        })

});

$('.__session_data_assesor1').click(function() {

    const __Id = $(this).attr('__id');
    const __Slugs = $(this).attr('__slugs');
    const __Url = $(this).attr('__url');

    swal({
            title: "Informasi",
            text: "" + __Slugs + "",
            icon: "info",
            buttons: {
                confirm: {
                    text: 'Validasi',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        })
        .then((Active) => {
            if (Active) {
                window.location.replace(
                    '' + __Url + ''
                );
            } else {
                swal("Batal Untuk Validasi Data !", {
                    buttons: {
                        confirm: {
                            className: 'btn btn-warning'
                        }
                    },
                });
            }
        })

});

$('.__session_data_assesor2').click(function() {

    const __Id = $(this).attr('__id');
    const __Slugs = $(this).attr('__slugs');
    const __Url = $(this).attr('__url');

    swal({
            title: "Informasi",
            text: "" + __Slugs + "",
            icon: "info",
            buttons: {
                confirm: {
                    text: 'Validasi',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        })
        .then((Active) => {
            if (Active) {
                window.location.replace(
                    '' + __Url + ''
                );
            } else {
                swal("Batal Untuk Validasi Data !", {
                    buttons: {
                        confirm: {
                            className: 'btn btn-warning'
                        }
                    },
                });
            }
        })

});

$('.__session_data_assesor3').click(function() {

    const __Id = $(this).attr('__id');
    const __Slugs = $(this).attr('__slugs');
    const __Url = $(this).attr('__url');

    swal({
            title: "Informasi",
            text: "" + __Slugs + "",
            icon: "info",
            buttons: {
                confirm: {
                    text: 'Validasi',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        })
        .then((Active) => {
            if (Active) {
                window.location.replace(
                    '' + __Url + ''
                );
            } else {
                swal("Batal Untuk Validasi Data !", {
                    buttons: {
                        confirm: {
                            className: 'btn btn-warning'
                        }
                    },
                });
            }
        })

});

$('.__session_data_validasi').click(function() {

    const __Id = $(this).attr('__id');
    const __Slugs = $(this).attr('__slugs');
    const __Url = $(this).attr('__url');

    swal({
            title: "Informasi",
            text: "" + __Slugs + "",
            icon: "info",
            buttons: {
                confirm: {
                    text: 'Validasi',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        })
        .then((Active) => {
            if (Active) {
                window.location.replace(
                    '' + __Url + ''
                );
            } else {
                swal("Batal Untuk Validasi Data !", {
                    buttons: {
                        confirm: {
                            className: 'btn btn-warning'
                        }
                    },
                });
            }
        })

});