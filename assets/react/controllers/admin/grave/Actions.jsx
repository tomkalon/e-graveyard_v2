import React from 'react';
import Button from "@Modules/Button";
import Dialog from "@Modules/Dialog";
import DeleteIcon from '@mui/icons-material/Delete';
import EditNoteIcon from '@mui/icons-material/EditNote';
import VisibilityRoundedIcon from '@mui/icons-material/VisibilityRounded';

import {
    trans, UI_BUTTONS_DETAILS
} from '@Translator';

export default function (props) {
    const [open, setOpen] = React.useState(false);

    const handleClickOpen = (action) => {
    };

    const handleClose = () => {
    };

    return <div className="flex justify-end gap-2">
        <Button buttonColor={'btn-info'} onClick={handleClickOpen('view')}>
            <VisibilityRoundedIcon />
        </Button>
        <Button buttonColor={'btn-warning'} onClick={handleClickOpen('edit')}>
            <EditNoteIcon />
        </Button>
        <Button buttonColor={'btn-danger'} onClick={handleClickOpen('delete')}>
            <DeleteIcon />
        </Button>
        <Dialog />
    </div>;
}
