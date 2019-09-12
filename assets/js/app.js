$(function() {
    // 削除ボタン
    // $('.delete-button').on('click', function(e) {
    $(document).on('click', '.delete-button', function(e) { // 後から追加されたやつに対しても有効になる

        // aタグのリンク機能を無効化 delete.phpに飛ばない=削除機能は行われない
        e.preventDefault();

        // クリックされたタスクのIDを取得(data-id属性にIDがある)
        let id = $(this).data('id');
        
        // ajax処理を開始
        $.ajax({
            url: 'http://localhost/TodoApp/delete.php',
            type: 'GET',
            datatype: 'json',
            data: { // 送信先にデータを渡す 左: キー(引き出しの名前) 右: 送信される値
                id: id
            }
        }).done(() => {
            // 成功したとき、該当タスクを画面から削除
            // $(this).parent().parent().remove(); // これでも削除できる
            $('#task-'+ id).fadeOut();

        }).fail(() => {

        });
    })

    // 追加ボタン
    $('#add-btn').on('click', function(e){
        // 送信処理を無効化
        e.preventDefault();

        let task = $('.form-control').val();

        $.ajax({
            url: 'http://localhost/TodoApp/create.php',
            type: 'POST',
            datatype: 'json',
            data: { // 送信先にデータを渡す 左: キー(引き出しの名前) 右: 送信される値
                task: task
            }
        }).done((newTask) => {
            // 通信結果の確認
            console.log(newTask);
            // 配列から取得
            let data = newTask[0];
            console.log(data);

            // tbodyのなかに、新しいタスク用にtrタグ等を作成する
            $('tbody').append(
                `<tr id=task-${data['id']}>
                    <td>${data['name']}</td>
                    <td>${data['due_date']}</td>
                    <td><a class="text-success" href="edit.php?id=${data['id']}">EDIT</a></td>
                    <td><a class="text-danger delete-button" data-id="${data['id']}" href="delete.php?id=${data['id']}">DELETE</a></td>
                <tr>`
            );

            $('.form-control').val(null);





            // IDを取得 -----------------------------------ここから自分のやつ
            // console.log(data["id"]);
            // console.log(data["name"]);
            // console.log(data["due_date"]);

            // prevId = data["id"]-1;
            // console.log(prevId);


            // let tr = $('<tr id=task-' + data["id"] + '>');
            // let td1 = $('<td>' + data["name"] + '</td>');
            // let td2 = $('<td>' + data["due_date"] + '</td>');
            // let td3 = $('<td>' + '<a class="text-success" href="edit.php?id=' + data["id"] + '">EDIT</a>' + '</td>');
            // let td4 = $('<td>' + '<a class="text-danger delete-button" data-id="' + data["id"] +  '" href="delete.php?id=' + data["id"] + '>DELETE</a>' + '</td>');

            // console.log(tr);
            // console.log(td1);
            // console.log(td2);
            // console.log(td3);



        }).fail(() => {

        })
    });

})