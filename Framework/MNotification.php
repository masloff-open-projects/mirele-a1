<?php

/**
 * The class manages the notifications sent by the system.
 */

class MNotification {

    private $data = [];

    public function send ($id=0, $priority=1, $title='New notify', $content='') {

        if (is_integer($id) and is_integer($priority) and $title and $content) {

            if (count($this->data) === 0) {

                # Push notification
                return array_push($this->data, [
                    "id" => $id,
                    "priority" => $priority,
                    "title" => $title,
                    "content" => $content
                ]);

            } else {

                # Check if notification with get ID already exists
                foreach ($this->data as $notification) {
                    if ($notification['id'] === $id) {
                        throw new Exception ('The notification with tam ID has already been sent. You can edit it using the "edit" method.');
                    }
                }

                # Push notification
                return array_push($this->data, [
                    "id" => $id,
                    "priority" => $priority,
                    "title" => $title,
                    "content" => $content
                ]);

            }

        }

    }

    public function exists ($id=0) {

        foreach ($this->data as $notification) {
            if ($notification['id'] === $id) {
                return true;
            }
        }

        return false;

    }

    public function all () {
        return $this->data;
    }

}